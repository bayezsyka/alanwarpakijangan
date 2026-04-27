<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $descriptionText = trim(preg_replace('/\s+/', ' ', strip_tags($article->isi ?? '')));
        $seoDescription = \Illuminate\Support\Str::limit($descriptionText, 155, '');
        $canonicalUrl = \App\Support\SeoUrl::articleUrl($article);
        $seoImageUrl = \App\Support\SeoUrl::articleImageUrl($article->gambar);
        $publisherName = 'Pondok Pesantren Al-Anwar Pakijangan';
        $publisherLogoUrl = \App\Support\SeoUrl::assetUrl('images/logo.webp');
        $authorName = $article->penulis ?? $article->user->name ?? 'Admin';
        $publishedDate = $article->tanggal
            ? \Illuminate\Support\Carbon::parse($article->tanggal)->toAtomString()
            : optional($article->created_at)->toAtomString();
        $modifiedDate = optional($article->updated_at)->toAtomString();
        $articleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $article->judul,
            'description' => $seoDescription,
            'image' => [$seoImageUrl],
            'url' => $canonicalUrl,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonicalUrl,
            ],
            'datePublished' => $publishedDate,
            'dateModified' => $modifiedDate,
            'author' => [
                '@type' => 'Person',
                'name' => $authorName,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $publisherName,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $publisherLogoUrl,
                ],
            ],
        ];
    @endphp
    <title>{{ $article->judul }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $article->judul }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $seoImageUrl }}">
    <meta property="article:published_time" content="{{ $publishedDate }}">
    <meta property="article:modified_time" content="{{ $modifiedDate }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $article->judul }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImageUrl }}">
    <script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo.webp') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Improved typography for better reading experience */
        .article-content {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #333;
            line-height: 1.8;
            font-size: 1.125rem; /* 18px base size */
        }
        
        .article-content h1,
        .article-content h2,
        .article-content h3 {
            font-family: 'Instrument Sans', sans-serif;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            line-height: 1.3;
            color: #1a1a1a;
        }
        
        .article-content h1 { font-size: 2rem; }
        .article-content h2 { font-size: 1.75rem; }
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
            color: #005a46;
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
            border-left: 4px solid #008362;
            padding: 1rem 1.5rem;
            margin: 2rem 0;
            background-color: #f8f9fa;
            font-style: italic;
            color: #555;
        }
        
        .article-content pre {
            background-color: #f3f4f6;
            padding: 1.25rem;
            border-radius: 0.375rem;
            overflow-x: auto;
            margin: 1.5rem 0;
            font-size: 0.95rem;
        }
        
        .article-content img {
            max-width: 100%;
            height: auto;
            margin: 2rem auto;
            display: block;
            border-radius: 0.5rem;
        }
        
        /* Reading progress indicator */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: #008362;
            z-index: 40; /* Lower than navbar z-50 */
            transition: width 0.1s;
        }
        
        /* Table of contents */
        .toc {
            position: fixed;
            left: 2rem;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-height: 80vh;
            overflow-y: auto;
            display: none;
        }
        
        .toc ul {
            list-style: none;
            padding-left: 0;
        }
        
        .toc li {
            margin-bottom: 0.5rem;
        }
        
        .toc a {
            color: #333;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .toc a:hover {
            color: #008362;
        }
        
        @media (max-width: 1024px) {
            .toc {
                display: none !important;
            }
        }
        
        /* Reading time and progress */
        .reading-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #666;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
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
            .article-content {
                font-size: 1rem;
            }
            
            .article-content h1 { font-size: 1.75rem; }
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
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Reading progress bar -->
    <div class="reading-progress" id="readingProgress"></div>
    
    @if(isset($isPreview) && $isPreview)
        <div class="fixed bottom-6 left-6 z-[100] max-w-[calc(100%-3rem)] sm:max-w-xs pointer-events-none fade-in">
            <div class="bg-gray-900/95 backdrop-blur-xl text-white p-1 rounded-2xl shadow-2xl border border-white/10 flex items-center pointer-events-auto overflow-hidden group">
                {{-- Preview Icon --}}
                <div class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center border border-emerald-500/30 flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                
                {{-- Text Content --}}
                <div class="px-3 py-1 pr-1 flex flex-col justify-center min-w-0">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-emerald-400 leading-none mb-1">Preview</p>
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-bold text-white/90 truncate">{{ strtoupper($article->status) }}</span>
                        <div class="w-1 h-1 rounded-full bg-white/20"></div>
                        <button onclick="window.close()" class="text-[10px] font-black text-white/40 hover:text-red-400 transition-colors uppercase tracking-widest flex items-center gap-1 group/close">
                            <span>Tutup</span>
                            <svg class="w-3 h-3 group-hover/close:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
            @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
            .fade-in { animation: fadeIn 0.5s ease-out forwards; }
        </style>
    @endif
    
    <!-- Navbar hidden on mobile for cleaner reading experience -->
    <div class="hidden sm:block">
        @include('layouts.nav')
    </div>
    
    <!-- Floating share buttons - hidden on mobile, shown on desktop -->
    <div class="floating-share hidden sm:flex">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($canonicalUrl) }}" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-300 shadow-md" aria-label="Share ke Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode($canonicalUrl) }}&text={{ urlencode($article->judul) }}" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-400 text-white rounded-full hover:bg-blue-500 transition duration-300 shadow-md" aria-label="Share ke Twitter"><i class="fab fa-twitter"></i></a>
        <a href="https://wa.me/?text={{ urlencode($article->judul . ' ' . $canonicalUrl) }}" target="_blank" class="w-10 h-10 flex items-center justify-center bg-green-500 text-white rounded-full hover:bg-green-600 transition duration-300 shadow-md" aria-label="Share ke WhatsApp"><i class="fab fa-whatsapp"></i></a>
        <!-- Share Snippet (quote-to-image) -->
        <button id="ssOpenBtn" data-ss-open class="w-10 h-10 flex items-center justify-center bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition duration-300 shadow-md" aria-label="Bagikan kutipan"><i class="fas fa-quote-right"></i></button>
        <button onclick="copyToClipboard('{{ $canonicalUrl }}')" class="w-10 h-10 flex items-center justify-center bg-gray-600 text-white rounded-full hover:bg-gray-700 transition duration-300 shadow-md" aria-label="Copy link"><i class="fas fa-link"></i></button>
    </div>
    
    <main class="flex-grow container mx-auto px-2 sm:px-4 pt-2 sm:pt-24 pb-4 sm:pb-8 max-w-3xl">
        <article class="bg-white rounded-lg sm:rounded-xl shadow-sm overflow-hidden">
            <!-- Article header with improved spacing -->
            <header class="px-4 sm:px-6 pt-4 sm:pt-8 pb-4 sm:pb-6">
                <div class="mb-4 sm:mb-6">
                    <a href="{{ route('artikel') }}" class="inline-flex items-center text-[#008362] hover:text-cyan-950 text-sm sm:text-base font-medium transition duration-300 mb-3 sm:mb-4">
                        <i class="fas fa-arrow-left mr-1.5 sm:mr-2"></i> Kembali
                    </a>
                    <h1 class="text-xl sm:text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-3 sm:mb-4">{{ $article->judul }}</h1>
                    
                    <div class="flex flex-col gap-2 text-xs sm:text-sm text-gray-600 mb-3 sm:mb-6">
                        <div class="flex items-center flex-wrap gap-2">
                            @php
                                $authorName = $article->penulis ?? $article->user->name ?? 'Admin';
                            @endphp
                            <div class="flex items-center bg-gray-50 px-3 py-1 rounded-full border border-gray-100">
                                <span class="text-gray-400 font-medium mr-1.5 whitespace-nowrap">Ditulis oleh:</span>
                                <span class="font-bold text-gray-800">{{ $authorName }}</span>
                            </div>
                            <span class="flex items-center text-gray-400 ml-1">
                                <i class="far fa-eye mr-1.5"></i>
                                <span class="font-medium">{{ $article->views }}x</span>
                            </span>
                        </div>
                        <div class="text-gray-500">
                            {{ $article->created_at->translatedFormat('d M Y') }}
                        </div>
                    </div>

                    <!-- Mobile quick actions (Share Snippet + Copy link) -->
                    <div class="sm:hidden mt-4 flex gap-2">
                        <button type="button" data-ss-open
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-xl bg-emerald-600 text-white font-semibold text-sm shadow hover:bg-emerald-700">
                            <i class="fas fa-quote-right mr-2"></i> Bagikan Kutipan
                        </button>
                        <button type="button" onclick="copyToClipboard('{{ $canonicalUrl }}')"
                                class="px-4 py-2 rounded-xl bg-gray-800 text-white font-semibold text-sm shadow hover:bg-gray-900" aria-label="Copy link">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>
                
                @if($article->gambar)
                    @php
                        $imageUrl = Illuminate\Support\Str::startsWith($article->gambar, 'http')
                            ? $article->gambar
                            : asset('storage/' . $article->gambar);
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-auto max-h-64 sm:max-h-96 object-cover rounded-lg mb-4 sm:mb-6 shadow-md">
                @endif
            </header>
            
            <!-- Article content with improved typography -->
            <div id="articleContent"
                 class="article-content px-6 pb-8"
                 data-ss-title="{{ $article->judul }}"
                 data-ss-url="{{ $canonicalUrl }}"
                 data-ss-brand="Pesantren Al-Anwar"
                 data-ss-logo="{{ $publisherLogoUrl }}">
                {!! $article->isi !!}
            </div>
            
            <!-- Article footer -->
            <footer class="px-6 py-6 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div class="mb-4 sm:mb-0">
                    </div>
                    <div class="flex space-x-4">
                        <button onclick="scrollToTop()" class="flex items-center text-gray-600 hover:text-[#008362] transition duration-300">
                            <i class="fas fa-arrow-up mr-2"></i> Ke Atas
                        </button>
                    </div>
                </div>
            </footer>
        </article>
    </main>

    <!-- Share Snippet: floating action shown near highlighted text -->
    <button id="ssSelectionBtn"
            class="hidden fixed z-[150] px-3 py-2 text-xs sm:text-sm font-semibold rounded-full bg-emerald-600 text-white shadow-lg hover:bg-emerald-700 transition"
            type="button">
        <i class="fas fa-quote-right mr-1"></i> Bagikan Kutipan
    </button>

    <!-- Share Snippet: modal (quote-to-image canvas renderer) -->
    <div id="shareSnippetModal" class="hidden fixed inset-0 z-[200]">
        <div class="absolute inset-0 bg-black/60" data-ss-close></div>

        <div class="relative mx-auto my-6 sm:my-10 w-[calc(100%-2rem)] max-w-2xl">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b flex items-center justify-between">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900">Bagikan Kutipan</h3>
                        <p class="text-xs sm:text-sm text-gray-500">Highlight teks di artikel untuk membuat quote card.</p>
                    </div>
                    <button class="p-2 rounded-lg hover:bg-gray-100" data-ss-close aria-label="Tutup" type="button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="p-4 sm:p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Left: controls -->
                    <div class="space-y-3">
                        <label class="block">
                            <span class="text-sm font-semibold text-gray-800">Kutipan</span>
                            <textarea id="ssQuoteInput" rows="6"
                                      class="mt-1 w-full rounded-xl border border-gray-200 p-3 text-sm leading-relaxed focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                      placeholder="Tempel atau highlight teks dari artikel…"></textarea>
                            <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                                <span id="ssCounter">0/320</span>
                                <span class="hidden sm:inline">Tips: kutipan ideal 1–3 kalimat</span>
                            </div>
                        </label>

                        <div class="flex items-center gap-2">
                            <label class="flex-1">
                                <span class="text-sm font-semibold text-gray-800">Format</span>
                                <select id="ssFormat"
                                        class="mt-1 w-full rounded-xl border border-gray-200 p-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"></select>
                            </label>
                            <button id="ssRenderBtn" type="button"
                                    class="mt-6 px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm font-semibold shadow hover:bg-emerald-700">
                                Render
                            </button>
                        </div>

                        <div class="rounded-xl bg-gray-50 border border-gray-200 p-3">
                            <div class="text-xs text-gray-500 mb-2">URL pendek</div>
                            <div id="ssUrlText" class="text-sm font-semibold text-gray-800 break-all"></div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-2">
                            <button id="ssDownloadBtn" type="button"
                                    class="w-full px-4 py-2 rounded-xl bg-gray-900 text-white text-sm font-semibold shadow hover:bg-gray-800">
                                <i class="fas fa-download mr-1"></i> Download PNG
                            </button>
                            <button id="ssShareBtn" type="button"
                                    class="w-full px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm font-semibold shadow hover:bg-emerald-700">
                                <i class="fas fa-share-alt mr-1"></i> Share
                            </button>
                        </div>

                        <button id="ssCopyLinkBtn" type="button"
                                class="w-full px-4 py-2 rounded-xl border border-gray-200 text-sm font-semibold text-gray-800 hover:bg-gray-50">
                            <i class="fas fa-link mr-1"></i> Copy Link
                        </button>
                    </div>

                    <!-- Right: preview -->
                    <div class="flex flex-col">
                        <div class="rounded-2xl bg-gray-50 border border-gray-200 p-3 flex-1 flex items-center justify-center">
                            <canvas id="ssCanvas" class="w-full h-auto rounded-xl shadow-sm"></canvas>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Jika tombol Share tidak muncul, gunakan Download lalu unggah manual (tergantung dukungan browser).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
                        text: 'Link artikel berhasil disalin.',
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
                    text: 'Link artikel berhasil disalin.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            } catch (err) {
                Swal.fire({
                    title: 'Gagal Menyalin',
                    text: 'Silakan salin secara manual.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
            document.body.removeChild(textArea);
        }
    </script>
</body>
</html>
