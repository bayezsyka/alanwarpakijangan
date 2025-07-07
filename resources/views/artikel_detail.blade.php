<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $article->judul }} - Pesantren Al-Anwar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    @include('layouts.nav')
    <main class="flex-grow container mx-auto max-w-4xl px-4 py-24">
        <article class="bg-white rounded-lg shadow-lg overflow-hidden p-6 sm:p-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $article->judul }}</h1>
            <div class="flex items-center text-gray-600 text-sm mb-6">
                <span class="mr-4">Tanggal: {{ \Carbon\Carbon::parse($article->tanggal)->format('d M Y') }}</span>
                <span>Oleh: {{ $article->penulis }}</span>
                 <span class="flex items-center ml-4">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Dilihat: {{ $article->views }} kali
                </span>
            </div>
            
            <div class="mb-6 flex flex-wrap items-center gap-2">
                <span class="text-gray-600 mr-2">Bagikan:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                   target="_blank" 
                   class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition duration-300"
                   aria-label="Share ke Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->judul) }}" 
                   target="_blank" 
                   class="bg-blue-400 text-white p-2 rounded-full hover:bg-blue-500 transition duration-300"
                   aria-label="Share ke Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://wa.me/?text={{ urlencode($article->judul . ' ' . url()->current()) }}" 
                   target="_blank" 
                   class="bg-green-500 text-white p-2 rounded-full hover:bg-green-600 transition duration-300"
                   aria-label="Share ke WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->judul) }}" 
                   target="_blank" 
                   class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition duration-300"
                   aria-label="Share ke Telegram">
                    <i class="fab fa-telegram-plane"></i>
                </a>
                <button onclick="copyToClipboard('{{ url()->current() }}')" 
                        class="bg-gray-600 text-white p-2 rounded-full hover:bg-gray-700 transition duration-300"
                        aria-label="Salin link">
                    <i class="fas fa-link"></i>
                </button>
            </div>
            
            @if($article->gambar)
                @php
                    $imageUrl = Illuminate\Support\Str::startsWith($article->gambar, 'http')
                        ? $article->gambar
                        : asset('storage/' . $article->gambar);
                @endphp
                <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-auto max-h-96 object-cover rounded-md mb-6">
            @endif
            <div class="prose max-w-none text-gray-800 leading-relaxed text-base sm:text-lg">
                {!! nl2br(e($article->isi)) !!}
            </div>
            <div class="mt-8">
                <a href="{{ route('artikel') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold transition duration-300">
                    &larr; Kembali ke Artikel
                </a>
            </div>
        </article>
    </main>
    @include('layouts.footer')

    {{-- ======================= PERUBAHAN DI SINI ======================= --}}
    <script>
        // Fungsi untuk copy link ke clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Ganti alert() dengan Swal.fire()
                Swal.fire({
                    title: 'Tersalin!',
                    text: 'Link artikel berhasil disalin.',
                    icon: 'success',
                    timer: 2000, // Notifikasi hilang setelah 2 detik
                    showConfirmButton: false
                });
            }, function(err) {
                // Tampilkan notifikasi error jika gagal
                Swal.fire({
                    title: 'Gagal Menyalin',
                    text: 'Maaf, terjadi kesalahan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                console.error('Gagal menyalin link: ', err);
            });
        }
    </script>
    {{-- =================================================================== --}}

    {{-- Notifikasi dari session (sudah benar, tidak perlu diubah) --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</body>
</html>