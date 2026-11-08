<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Rutinan;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Category;
use App\Support\SeoUrl;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ArtikelController extends Controller
{
    /**
     * Menampilkan halaman utama (welcome page).
     */
    public function welcome()
    {
        $artikelTerbaru = Article::published()->latest()->take(2)->get();

        $selasananTerbaru = \App\Models\SelasananEntry::where('is_published', true)
            ->orderByDesc('monday_date')
            ->first();

        $galeriSelasanan = \App\Models\SelasananEntry::where('is_published', true)
            ->whereNotNull('cover_image_path')
            ->orderByDesc('monday_date')
            ->take(6)
            ->get();

        $acaraTerbaru = Event::with('photos')->latest()->take(3)->get();

        $namaHari = [0 => 'Ahad', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];
        $rentangHari = [];

        for ($i = -2; $i <= 4; $i++) {
            $objekTanggal = new \DateTime();
            $objekTanggal->modify("$i days");

            $hari = Carbon::instance($objekTanggal);

            $rentangHari[] = [
                'full_date' => $hari->format('Y-m-d'),
                'day_of_week' => $hari->dayOfWeek,
                'day_name' => $namaHari[$hari->dayOfWeek],
                'date' => $hari->format('d'),
                'month' => strtoupper($hari->translatedFormat('M')),
                'is_today' => $hari->isToday(),
            ];
        }

        $rutinanPerHari = Rutinan::with('exceptions')->get()->sortBy('waktu')->groupBy('day_of_week');

        $pengumuman = Announcement::active()
            ->orderBy('start_date', 'desc')
            ->get();

        $dataPengumuman = $pengumuman->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->title,
                'gambar' => $item->image_url,
                'tautan' => $item->link,
            ];
        })->toArray();

        $jadwal = collect($rentangHari)->map(function (array $hari) use ($rutinanPerHari) {
            $rutinanHari = $rutinanPerHari->get($hari['day_of_week'], collect());

            return [
                'tanggal_penuh' => $hari['full_date'],
                'nama_hari' => $hari['day_name'],
                'tanggal' => $hari['date'],
                'bulan' => $hari['month'],
                'hari_ini' => $hari['is_today'],
                'kegiatan' => $rutinanHari->map(function (Rutinan $rutinan) use ($hari) {
                    return [
                        'id' => $rutinan->id,
                        'nama' => $rutinan->nama_acara,
                        'waktu' => Carbon::parse($rutinan->waktu)->format('H:i') . ' WIB',
                        'tempat' => $rutinan->tempat,
                        'pengisi' => $rutinan->pengisi,
                        'kitab' => $rutinan->kitab,
                        'keterangan' => $rutinan->isi,
                        'libur' => $rutinan->exceptions->contains('libur_date', $hari['full_date']),
                    ];
                })->values(),
            ];
        });

        return Inertia::render('Beranda', [
            'artikelTerbaru' => $artikelTerbaru->load(['user', 'category'])->map(fn (Article $article) => $this->presentasikanArtikel($article)),
            'selasananTerbaru' => $selasananTerbaru ? $this->presentasikanSelasanan($selasananTerbaru) : null,
            'jadwal' => $jadwal,
            'galeri' => $galeriSelasanan->map(fn ($entry) => [
                'id' => 'selasanan-' . $entry->id,
                'judul' => $entry->title,
                'gambar' => asset('storage/' . $entry->cover_image_path),
                'tautan' => route('selasanan.show', $entry->slug),
            ])->concat($acaraTerbaru->flatMap(fn (Event $event) => $event->photos->take(2)->map(fn ($photo) => [
                'id' => 'acara-' . $photo->id,
                'judul' => $event->nama_acara,
                'gambar' => asset('storage/' . $photo->file_path),
                'tautan' => route('galeri.index'),
            ])))->take(8)->values(),
            'pengumuman' => $dataPengumuman,
            'seo' => [
                'judul' => 'Pondok Pesantren Al-Anwar Pakijangan | Brebes',
                'deskripsi' => 'Pondok Pesantren Al-Anwar Pakijangan di Bulakamba, Brebes mengembangkan pendidikan salaf modern, Madrasah Diniyah, SMP, dan pembinaan karakter santri.',
                'canonical' => SeoUrl::baseUrl() . '/',
                'gambar' => SeoUrl::assetUrl('images/landingpage/bgppdb.png'),
                'schema' => [SeoUrl::organizationSchema(), SeoUrl::websiteSchema()],
            ],
        ]);
    }

    /**
     * Menampilkan halaman daftar semua artikel.
     */
    public function index(Request $request)
    {
        if (Article::published()->doesntExist()) {
            return redirect()->route('welcome');
        }

        $pencarian = trim((string) $request->query('q', ''));
        $kategori = trim((string) $request->query('kategori', ''));

        $artikel = Article::published()
            ->with(['user', 'category'])
            ->when($kategori, fn ($query) => $query->whereHas('category', fn ($q) => $q->where('slug', $kategori)))
            ->when($pencarian, fn ($query) => $query->where('judul', 'like', '%' . $pencarian . '%'))
            ->latest()
            ->paginate(9)
            ->withQueryString()
            ->through(fn (Article $article) => $this->presentasikanArtikel($article));

        return Inertia::render('Artikel/Indeks', [
            'artikel' => $artikel,
            'kategori' => Category::query()->orderBy('name')->get(['name', 'slug']),
            'filter' => ['q' => $pencarian, 'kategori' => $kategori],
            'seo' => [
                'judul' => 'Artikel | Pondok Pesantren Al-Anwar Pakijangan',
                'deskripsi' => 'Artikel Pondok Pesantren Al-Anwar Pakijangan tentang pendidikan pesantren, santri, keislaman, karakter, ilmu pengetahuan, dan kegiatan Al-Anwar.',
                'canonical' => SeoUrl::url('artikel'),
                'gambar' => SeoUrl::assetUrl('images/landingpage/bgppdb.png'),
                'schema' => [SeoUrl::breadcrumbSchema([
                    ['name' => 'Beranda', 'url' => SeoUrl::baseUrl() . '/'],
                    ['name' => 'Artikel', 'url' => SeoUrl::url('artikel')],
                ])],
            ],
        ]);
    }

    /**
     * Menampilkan halaman detail satu artikel.
     */
    public function show(Article $article)
    {
        $isPreview = false;
        
        if ($article->status !== 'published') {
            $canPreview = false;
            if (auth()->check()) {
                if (auth()->user()->isAdmin()) {
                    $canPreview = true;
                }
            }
            if (!$canPreview) {
                abort(404);
            }
            $isPreview = true;
        }

        // Jika dipanggil dari rute dengan query ?preview=true, paksa mode preview
        if (request()->has('preview')) {
            $isPreview = true;
        }

        $viewedKey = 'viewed_article_' . $article->id;
        if (!$isPreview && !session()->has($viewedKey)) {
            Article::withoutTimestamps(function () use ($article) {
                $article->increment('views');
            });

            // Pastikan tampilan mendapatkan nilai view terbaru tanpa mengubah informasi pembaruan
            $article->refresh();
            session()->put($viewedKey, true);
        }

        $article->load(['user', 'category']);
        $artikel = $this->presentasikanArtikel($article, true);
        $deskripsi = SeoUrl::cleanDescription($article->isi, 155);

        $artikelTerkait = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest()
            ->take(3)
            ->get();

        if ($artikelTerkait->count() < 3) {
            $kurang = 3 - $artikelTerkait->count();
            $tambahan = Article::published()
                ->where('id', '!=', $article->id)
                ->whereNotIn('id', $artikelTerkait->pluck('id'))
                ->latest()
                ->take($kurang)
                ->get();
            $artikelTerkait = $artikelTerkait->concat($tambahan);
        }

        $tanggalTerbit = $article->tanggal ? Carbon::parse($article->tanggal) : $article->created_at;

        return Inertia::render('Artikel/Detail', [
            'artikel' => $artikel,
            'artikelTerkait' => $artikelTerkait->map(fn (Article $item) => $this->presentasikanArtikel($item))->values(),
            'pratinjau' => $isPreview,
            'seo' => [
                'judul' => $article->judul . ' | Al-Anwar Pakijangan',
                'deskripsi' => $deskripsi,
                'canonical' => SeoUrl::articleUrl($article),
                'gambar' => SeoUrl::articleImageUrl($article->gambar),
                'jenis' => 'article',
                'schema' => [[
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'headline' => $article->judul,
                    'description' => $deskripsi,
                    'image' => [SeoUrl::articleImageUrl($article->gambar)],
                    'url' => SeoUrl::articleUrl($article),
                    'datePublished' => $tanggalTerbit?->toAtomString(),
                    'dateModified' => $article->updated_at?->toAtomString(),
                    'articleSection' => $article->category->name ?? 'Artikel',
                    'inLanguage' => 'id-ID',
                    'author' => ['@type' => 'Person', 'name' => $artikel['penulis']],
                    'publisher' => ['@type' => 'Organization', 'name' => 'Pondok Pesantren Al-Anwar Pakijangan'],
                ], SeoUrl::breadcrumbSchema([
                    ['name' => 'Beranda', 'url' => SeoUrl::baseUrl() . '/'],
                    ['name' => 'Artikel', 'url' => SeoUrl::url('artikel')],
                    ['name' => $article->judul, 'url' => SeoUrl::articleUrl($article)],
                ])],
            ],
        ]);
    }

    private function presentasikanArtikel(Article $article, bool $sertakanIsi = false): array
    {
        $jumlahKata = str_word_count(strip_tags($article->isi));
        $waktuBaca = max(1, (int) ceil($jumlahKata / 200)) . ' menit baca';

        $data = [
            'id' => $article->id,
            'judul' => $article->judul,
            'slug' => $article->slug,
            'tautan' => route('artikel.detail', $article->slug),
            'penulis' => $article->penulis ?? $article->user?->name ?? 'Admin',
            'kategori' => $article->category ? ['nama' => $article->category->name, 'slug' => $article->category->slug] : null,
            'ringkasan' => Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($article->isi))), 170),
            'gambar' => $article->gambar
                ? (Str::startsWith($article->gambar, ['http://', 'https://']) ? $article->gambar : asset('storage/' . ltrim($article->gambar, '/')))
                : asset('images/landingpage/bgppdb.png'),
            'tanggal' => $article->created_at?->locale('id')->translatedFormat('d F Y'),
            'tanggal_singkat' => $article->created_at?->locale('id')->translatedFormat('d M Y'),
            'dilihat' => $article->views,
            'waktu_baca' => $waktuBaca,
            'status' => $article->status,
        ];

        if ($sertakanIsi) {
            $data['isi'] = $article->isi;
        }

        return $data;
    }

    private function presentasikanSelasanan($entry): array
    {
        return [
            'id' => $entry->id,
            'judul' => $entry->title,
            'tautan' => route('selasanan.show', $entry->slug),
            'pembicara' => $entry->speaker,
            'tanggal' => $entry->monday_date?->locale('id')->translatedFormat('d F Y'),
            'gambar' => $entry->cover_image_path ? asset('storage/' . $entry->cover_image_path) : asset('images/landingpage/bgppdb.png'),
            'ada_audio' => filled($entry->audio_path),
        ];
    }
}
