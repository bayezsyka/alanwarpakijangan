<?php

namespace App\Http\Controllers\Selasanan;

use App\Http\Controllers\Controller;
use App\Models\SelasananEntry;
use App\Traits\LogsActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SelasananManageController extends Controller
{
    use LogsActivity;

    private const DEFAULT_SPEAKER = 'KH. Muhammad Miftah';
    private const DEFAULT_TIME_WIB = '20:00';

    public function index(Request $request)
    {
        $nowWib = Carbon::now('Asia/Jakarta');
        $mondayThisWeek = $nowWib->copy()->startOfWeek(Carbon::MONDAY);

        $currentYear = (int) $mondayThisWeek->year;
        $currentMonth = (int) $mondayThisWeek->month;
        $currentWeek = $this->weekOfMonthMondayBased($mondayThisWeek);

        $currentEntry = SelasananEntry::where('year', $currentYear)
            ->where('month', $currentMonth)
            ->where('week_of_month', $currentWeek)
            ->first();

        $q = trim((string) $request->query('q', ''));
        $year = $request->query('year');
        $month = $request->query('month');

        $entries = SelasananEntry::query()
            ->when($q !== '', fn ($qq) => $qq->where('title', 'like', '%' . $q . '%'))
            ->when($year, fn ($qq) => $qq->where('year', (int) $year))
            ->when($month, fn ($qq) => $qq->where('month', (int) $month))
            ->orderByDesc('monday_date')
            ->paginate(10)
            ->withQueryString();

        return view('manage.selasanan.index', [
            'entries' => $entries,
            'currentEntry' => $currentEntry,
            'currentYear' => $currentYear,
            'currentMonth' => $currentMonth,
            'currentWeek' => $currentWeek,
            'currentMondayDate' => $mondayThisWeek->toDateString(),
        ]);
    }

    public function create(Request $request)
    {
        $nowWib = Carbon::now('Asia/Jakarta');
        $monday = $nowWib->copy()->startOfWeek(Carbon::MONDAY);

        // optional prefill dari query (kalau klik "buat minggu ini")
        $prefMonday = $request->query('monday_date');
        if ($prefMonday) {
            $monday = Carbon::parse($prefMonday, 'Asia/Jakarta')->startOfWeek(Carbon::MONDAY);
        }

        $year = (int) $monday->year;
        $month = (int) $monday->month;
        $week = $this->weekOfMonthMondayBased($monday);

        return view('manage.selasanan.create', [
            'defaults' => [
                'speaker' => self::DEFAULT_SPEAKER,
                'monday_date' => $monday->toDateString(),
                'time_wib' => self::DEFAULT_TIME_WIB,
                'year' => $year,
                'month' => $month,
                'week_of_month' => $week,
                'is_published' => true,
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Input cepat
            'title' => ['required', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'audio_file' => ['nullable', 'file', 'mimetypes:audio/mpeg,audio/mp4,audio/x-m4a,audio/wav,audio/ogg', 'max:204800'],
            'isi' => ['required', 'string'],

            // Lebih lanjut (opsional)
            'speaker' => ['nullable', 'string', 'max:255'],
            'monday_date' => ['nullable', 'date'],
            'time_wib' => ['nullable', 'date_format:H:i'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $nowWib = Carbon::now('Asia/Jakarta');

        $monday = isset($validated['monday_date']) && $validated['monday_date']
            ? Carbon::parse($validated['monday_date'], 'Asia/Jakarta')->startOfWeek(Carbon::MONDAY)
            : $nowWib->copy()->startOfWeek(Carbon::MONDAY);

        $timeWib = $validated['time_wib'] ?? self::DEFAULT_TIME_WIB;
        $speaker = $validated['speaker'] ?? self::DEFAULT_SPEAKER;

        $year = (int) $monday->year;
        $month = (int) $monday->month;
        $week = $this->weekOfMonthMondayBased($monday);

        $slug = $this->generateUniqueSlug($validated['title'], $monday->toDateString());

        $data = [
            'title' => $validated['title'],
            'slug' => $slug,
            'speaker' => $speaker,
            'monday_date' => $monday->toDateString(),
            'time_wib' => $timeWib . ':00',
            'year' => $year,
            'month' => $month,
            'week_of_month' => $week,
            'isi' => $validated['isi'],
            'is_published' => (bool) ($validated['is_published'] ?? true),
            'created_by' => auth()->id(),
        ];

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $request->file('cover_image')->store('selasanan/cover', 'public');
        }

        if ($request->hasFile('audio_file')) {
            $audio = $request->file('audio_file');
            $data['audio_path'] = $audio->store('selasanan/audio', 'public');
            $data['audio_mime'] = $audio->getClientMimeType();
            $data['audio_size'] = $audio->getSize();
        }

        // Kalau minggu tsb sudah ada, lebih aman kasih error biar tidak dobel
        $exists = SelasananEntry::where('year', $year)
            ->where('month', $month)
            ->where('week_of_month', $week)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Entry untuk minggu tersebut sudah ada. Silakan edit yang sudah ada.');
        }

        $entry = SelasananEntry::create($data);

        $this->logActivity('buat selasanan', 'Judul: ' . $entry->title . ' | ' . $entry->monday_date);

        return redirect()->route('manage.selasanan.index')->with('success', 'Selasanan berhasil dibuat.');
    }

    public function edit(SelasananEntry $entry)
    {
        return view('manage.selasanan.edit', compact('entry'));
    }

    public function update(Request $request, SelasananEntry $entry)
    {
        $validated = $request->validate([
            // Input cepat
            'title' => ['required', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'audio_file' => ['nullable', 'file', 'mimetypes:audio/mpeg,audio/mp4,audio/x-m4a,audio/wav,audio/ogg', 'max:204800'],
            'isi' => ['required', 'string'],

            // Lebih lanjut
            'speaker' => ['nullable', 'string', 'max:255'],
            'monday_date' => ['nullable', 'date'],
            'time_wib' => ['nullable', 'date_format:H:i'],
            'is_published' => ['nullable', 'boolean'],

            // opsional: hapus file
            'remove_cover' => ['nullable', 'boolean'],
            'remove_audio' => ['nullable', 'boolean'],
        ]);

        $monday = isset($validated['monday_date']) && $validated['monday_date']
            ? Carbon::parse($validated['monday_date'], 'Asia/Jakarta')->startOfWeek(Carbon::MONDAY)
            : Carbon::parse($entry->monday_date, 'Asia/Jakarta')->startOfWeek(Carbon::MONDAY);

        $year = (int) $monday->year;
        $month = (int) $monday->month;
        $week = $this->weekOfMonthMondayBased($monday);

        // Jika minggu berubah, pastikan tidak bentrok
        $conflict = SelasananEntry::where('year', $year)
            ->where('month', $month)
            ->where('week_of_month', $week)
            ->where('id', '!=', $entry->id)
            ->exists();

        if ($conflict) {
            return back()->withInput()->with('error', 'Target minggu sudah terisi entry lain. Pilih minggu lain.');
        }

        $data = [
            'title' => $validated['title'],
            'speaker' => $validated['speaker'] ?? self::DEFAULT_SPEAKER,
            'monday_date' => $monday->toDateString(),
            'time_wib' => (($validated['time_wib'] ?? substr($entry->time_wib, 0, 5) ?? self::DEFAULT_TIME_WIB) . ':00'),
            'year' => $year,
            'month' => $month,
            'week_of_month' => $week,
            'isi' => $validated['isi'],
            'is_published' => (bool) ($validated['is_published'] ?? $entry->is_published),
        ];

        // Update slug kalau judul / tanggal berubah (biar SEO tetap rapih)
        $data['slug'] = $this->generateUniqueSlug($validated['title'], $monday->toDateString(), $entry->id);

        // Remove cover
        if (($validated['remove_cover'] ?? false) && $entry->cover_image_path) {
            Storage::disk('public')->delete($entry->cover_image_path);
            $data['cover_image_path'] = null;
        }

        // Remove audio
        if (($validated['remove_audio'] ?? false) && $entry->audio_path) {
            Storage::disk('public')->delete($entry->audio_path);
            $data['audio_path'] = null;
            $data['audio_mime'] = null;
            $data['audio_size'] = null;
        }

        // Replace cover
        if ($request->hasFile('cover_image')) {
            if ($entry->cover_image_path) {
                Storage::disk('public')->delete($entry->cover_image_path);
            }
            $data['cover_image_path'] = $request->file('cover_image')->store('selasanan/cover', 'public');
        }

        // Replace audio
        if ($request->hasFile('audio_file')) {
            if ($entry->audio_path) {
                Storage::disk('public')->delete($entry->audio_path);
            }
            $audio = $request->file('audio_file');
            $data['audio_path'] = $audio->store('selasanan/audio', 'public');
            $data['audio_mime'] = $audio->getClientMimeType();
            $data['audio_size'] = $audio->getSize();
        }

        $entry->update($data);

        $this->logActivity('edit selasanan', 'Judul: ' . $entry->title . ' | ' . $entry->monday_date);

        return redirect()->route('manage.selasanan.index')->with('success', 'Selasanan berhasil diperbarui.');
    }

    public function destroy(SelasananEntry $entry)
    {
        if ($entry->cover_image_path) {
            Storage::disk('public')->delete($entry->cover_image_path);
        }
        if ($entry->audio_path) {
            Storage::disk('public')->delete($entry->audio_path);
        }

        $this->logActivity('hapus selasanan', 'Judul: ' . $entry->title . ' | ' . $entry->monday_date);

        $entry->delete();

        return redirect()->route('manage.selasanan.index')->with('success', 'Selasanan berhasil dihapus.');
    }

    private function weekOfMonthMondayBased(Carbon $date): int
    {
        // Week-of-month berbasis minggu dimulai Senin.
        $firstDay = $date->copy()->startOfMonth();
        $firstDow = $firstDay->dayOfWeekIso; // 1 (Mon) ... 7 (Sun)
        $dom = $date->day; // 1..31

        return (int) floor(($dom + ($firstDow - 1) - 1) / 7) + 1;
    }

    private function generateUniqueSlug(string $title, string $mondayDate, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $base = $base !== '' ? $base : 'selasanan';

        $slug = $base . '-' . $mondayDate;

        $i = 1;
        while (true) {
            $q = SelasananEntry::where('slug', $slug);
            if ($ignoreId) {
                $q->where('id', '!=', $ignoreId);
            }
            if (!$q->exists()) break;

            $i++;
            $slug = $base . '-' . $mondayDate . '-' . $i;
        }

        return $slug;
    }
}
