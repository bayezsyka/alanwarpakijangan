<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $selasanan->title }} - Kajian Selasanan | Pesantren Al-Anwar</title>
    <meta name="description" content="Jurnal Kajian Rutinan Selasanan - {{ $selasanan->title }}. {{ \Illuminate\Support\Str::limit(strip_tags($selasanan->isi), 150) }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:500,600,700|dm-sans:400,500,600,700" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo.webp') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Improved typography for better reading experience */
        .article-content {
            font-family: 'DM Sans', sans-serif;
            color: #2a2a26;
            line-height: 1.8;
            font-size: 1.125rem;
        }
        
        .article-content h1,
        .article-content h2,
        .article-content h3 {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 600;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            line-height: 1.3;
            color: #1b1b18;
        }
        
        .article-content h1 { font-size: 2.25rem; letter-spacing: -0.02em; }
        .article-content h2 { font-size: 1.875rem; letter-spacing: -0.015em; }
        .article-content h3 { font-size: 1.5rem; }
        
        .article-content p {
            margin-bottom: 1.5rem;
            text-align: justify;
            hyphens: auto;
        }
        
        .article-content a {
            color: #008362;
            text-decoration: underline;
            transition: color 0.2s;
        }
        
        .article-content a:hover {
            color: #006b50;
        }
        
        .article-content ul,
        .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }
        
        .article-content li {
            margin-bottom: 0.75rem;
            position: relative;
        }
        
        .article-content blockquote {
            border-left: 3px solid #008362;
            padding: 1rem 1.5rem;
            margin: 2rem 0;
            background-color: #f6f4ef;
            font-family: 'Playfair Display', Georgia, serif;
            font-style: italic;
            color: #1b1b18;
            font-size: 1.125rem;
            border-radius: 0 10px 10px 0;
        }
        
        .article-content pre {
            background-color: #f3f4f6;
            padding: 1.25rem;
            border-radius: 10px;
            overflow-x: auto;
            margin: 1.5rem 0;
            font-size: 0.95rem;
        }
        
        .article-content img {
            max-width: 100%;
            height: auto;
            margin: 2rem auto;
            display: block;
            border-radius: 10px;
        }
        
        /* Reading progress indicator */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(to right, #008362, #b8932d);
            z-index: 60;
            transition: width 0.1s;
        }
        
        /* Audio player styling */
        .audio-player-card {
            background: #f6f4ef;
            border: 1px solid rgba(27, 27, 24, 0.10);
        }
        
        /* Floating share buttons */
        .floating-share {
            position: fixed;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            z-index: 100;
        }
        
        @media (max-width: 768px) {
            .article-content { font-size: 1rem; }
            .article-content h1 { font-size: 1.875rem; }
            .article-content h2 { font-size: 1.5rem; }
            .article-content h3 { font-size: 1.25rem; }
            
            .floating-share {
                position: static;
                flex-direction: row;
                transform: none;
                justify-content: center;
                margin: 2rem 0;
            }
        }
    </style>
</head>
<body class="bg-surface-alt min-h-screen flex flex-col font-sans">
    <!-- Reading progress bar -->
    <div class="reading-progress" id="readingProgress"></div>
    
    <!-- Navbar hidden on mobile for cleaner reading experience -->
    <div class="hidden sm:block">
        @include('layouts.nav')
    </div>
    
    <!-- Floating share buttons - hidden on mobile, shown on desktop -->
    <div class="floating-share hidden sm:flex">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-300 shadow-md" aria-label="Share ke Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($selasanan->title) }}" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-400 text-white rounded-full hover:bg-blue-500 transition duration-300 shadow-md" aria-label="Share ke Twitter"><i class="fab fa-twitter"></i></a>
        <a href="https://wa.me/?text={{ urlencode($selasanan->title . ' ' . url()->current()) }}" target="_blank" class="w-10 h-10 flex items-center justify-center bg-green-500 text-white rounded-full hover:bg-green-600 transition duration-300 shadow-md" aria-label="Share ke WhatsApp"><i class="fab fa-whatsapp"></i></a>
        <button onclick="copyToClipboard('{{ url()->current() }}')" class="w-10 h-10 flex items-center justify-center bg-gray-600 text-white rounded-full hover:bg-gray-700 transition duration-300 shadow-md" aria-label="Copy link"><i class="fas fa-link"></i></button>
    </div>
    
    
    <main class="flex-grow container-editorial px-2 sm:px-4 pt-2 sm:pt-24 pb-4 sm:pb-8 max-w-3xl">
        <article class="bg-surface rounded-lg shadow-soft overflow-hidden border border-black/8">
            <!-- Article header with improved spacing -->
            <header class="px-4 sm:px-8 pt-6 sm:pt-10 pb-4 sm:pb-6">
                <div class="mb-4 sm:mb-6">
                    <a href="{{ route('selasanan.index') }}" class="inline-flex items-center text-[11px] font-bold uppercase tracking-[0.14em] text-muted hover:text-primary transition duration-300 mb-4">
                        <i class="fas fa-arrow-left mr-2 text-[10px]"></i> Kembali ke Arsip
                    </a>
                    
                    {{-- Badge Kajian Selasanan --}}
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="inline-flex items-center gap-1.5 bg-primary text-white text-[11px] font-bold px-3 py-1.5 rounded-full">
                            <i class="fas fa-book-open text-[10px]"></i> Selasanan
                        </span>
                        <span class="bg-primary-soft text-primary text-[11px] font-bold px-3 py-1.5 rounded-full">
                            {{ \Carbon\Carbon::create($selasanan->year, $selasanan->month, 1)->locale('id')->translatedFormat('M Y') }}, Minggu {{ $selasanan->week_of_month }}
                        </span>
                    </div>
                    
                    <h1 class="font-display text-2xl sm:text-3xl md:text-4xl font-semibold text-dark leading-[1.15] tracking-[-0.02em] mb-4">{{ $selasanan->title }}</h1>
                    
                    <div class="flex flex-col gap-2 text-sm text-muted mb-4 sm:mb-6">
                        <div class="flex items-center flex-wrap gap-2">
                            @php
                                $speakerName = $selasanan->speaker ?? 'KH. Muhammad Miftah';
                                $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($speakerName) . "&background=008362&color=fff&size=32";
                            @endphp
                            <img src="{{ $avatarUrl }}" class="w-6 h-6 rounded-full" alt="{{ $speakerName }}">
                            <span class="font-bold text-dark">{{ $speakerName }}</span>
                        </div>
                        <div class="text-muted">
                            Senin, {{ $selasanan->monday_date->locale('id')->translatedFormat('d M Y') }}
                        </div>
                    </div>
                </div>
                
                @if($selasanan->cover_image_path)
                    <img src="{{ asset('storage/' . $selasanan->cover_image_path) }}" alt="{{ $selasanan->title }}" class="w-full h-auto max-h-64 sm:max-h-96 object-cover rounded-md mb-4 sm:mb-6 shadow-card">
                @endif
            </header>
            
            {{-- Audio Player Section --}}
            @if($selasanan->audio_path)
                <div class="mx-6 sm:mx-8 mb-6">
                    <div class="audio-player-card rounded-md p-6 shadow-card">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                                <i class="fas fa-headphones text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-display font-semibold text-dark">Rekaman Audio Kajian</h3>
                                <p class="text-sm text-muted">Dengarkan atau unduh rekaman kajian</p>
                            </div>
                        </div>
                        
                        <audio controls class="w-full mb-4" style="border-radius: 12px;">
                            <source src="{{ asset('storage/' . $selasanan->audio_path) }}" type="{{ $selasanan->audio_mime ?? 'audio/mpeg' }}">
                            Browser Anda tidak mendukung pemutar audio.
                        </audio>
                        
                        <a href="{{ route('selasanan.download', $selasanan->slug) }}" 
                           class="btn btn-primary !min-h-[44px] !text-xs">
                            <i class="fas fa-download text-[10px]"></i>
                            Download Audio
                            @if($selasanan->audio_size)
                                <span class="text-white/70 text-xs">({{ number_format($selasanan->audio_size / 1048576, 1) }} MB)</span>
                            @endif
                        </a>
                    </div>
                </div>
            @endif
            
            <!-- Article content with improved typography -->
            <div class="article-content px-6 pb-8">
                {!! $selasanan->isi !!}
            </div>
            
            <!-- Article footer -->
            <footer class="px-6 sm:px-8 py-6 border-t border-black/8">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div class="mb-4 sm:mb-0">
                    </div>
                    <div class="flex space-x-4">
                        <button onclick="scrollToTop()" class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:gap-3 transition-all">
                            <i class="fas fa-arrow-up"></i> Ke Atas
                        </button>
                    </div>
                </div>
            </footer>
        </article>
    </main>
    
    @include('layouts.footer')

    <script>        
        // Reading progress indicator
        function updateReadingProgress() {
            const progressBar = document.getElementById('readingProgress');
            if (!progressBar) return;
            
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = height > 0 ? (winScroll / height) * 100 : 0;
            progressBar.style.width = scrolled + "%";
        }
        
        // Scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        
        window.onscroll = function() {
            updateReadingProgress();
        };
        
        // Copy link function with fallback
        function copyToClipboard(text) {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(function() {
                    Swal.fire({
                        title: 'Tersalin!',
                        text: 'Link jurnal berhasil disalin.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }, function(err) {
                    fallbackCopy(text);
                });
            } else {
                fallbackCopy(text);
            }
        }
        
        function fallbackCopy(text) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.left = "-999999px";
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                Swal.fire({
                    title: 'Tersalin!',
                    text: 'Link jurnal berhasil disalin.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            } catch (err) {
                Swal.fire({
                    title: 'Gagal Menyalin',
                    text: 'Silakan salin secara manual: ' + text,
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
            document.body.removeChild(textArea);
        }
    </script>
</body>
</html>
