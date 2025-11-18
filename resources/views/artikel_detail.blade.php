<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $article->judul }} - Pesantren Al-Anwar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
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
            z-index: 1000;
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
    
    @include('layouts.nav')
    
    <!-- Floating share buttons -->
    <div class="floating-share">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-300 shadow-md" aria-label="Share ke Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->judul) }}" target="_blank" class="w-10 h-10 flex items-center justify-center bg-blue-400 text-white rounded-full hover:bg-blue-500 transition duration-300 shadow-md" aria-label="Share ke Twitter"><i class="fab fa-twitter"></i></a>
        <a href="https://wa.me/?text={{ urlencode($article->judul . ' ' . url()->current()) }}" target="_blank" class="w-10 h-10 flex items-center justify-center bg-green-500 text-white rounded-full hover:bg-green-600 transition duration-300 shadow-md" aria-label="Share ke WhatsApp"><i class="fab fa-whatsapp"></i></a>
        <button onclick="copyToClipboard('{{ url()->current() }}')" class="w-10 h-10 flex items-center justify-center bg-gray-600 text-white rounded-full hover:bg-gray-700 transition duration-300 shadow-md" aria-label="Copy link"><i class="fas fa-link"></i></button>
    </div>
    
    <main class="flex-grow container mx-auto px-4 py-16 max-w-3xl">
        <article class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Article header with improved spacing -->
            <header class="px-6 pt-8 pb-6">
                <div class="mb-6">
                    <a href="{{ route('artikel') }}" class="inline-flex items-center text-[#008362] hover:text-cyan-950 font-medium transition duration-300 mb-4">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Artikel
                    </a>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-4">{{ $article->judul }}</h1>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-sm text-gray-600 mb-6">
                        <div class="flex items-center">
                            <span class="font-medium mr-2">Oleh:</span>
                            <span>{{ $article->penulis }}</span>
                            <span class="mx-2 text-gray-400">•</span>
                            <span class="flex items-center">
                                <i class="far fa-eye mr-1.5"></i>
                                {{ $article->views }}x dilihat
                            </span>
                        </div>
                        <div class="flex flex-col sm:items-end">
                            <span>Diterbitkan: {{ $article->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                        </div>
                    </div>
                </div>
                
                @if($article->gambar)
                    @php
                        $imageUrl = Illuminate\Support\Str::startsWith($article->gambar, 'http')
                            ? $article->gambar
                            : asset('storage/' . $article->gambar);
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $article->judul }}" class="w-full h-auto max-h-96 object-cover rounded-lg mb-6 shadow-md">
                @endif
            </header>
            
            <!-- Article content with improved typography -->
            <div class="article-content px-6 pb-8">
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
    
    @include('layouts.footer')

    <script>        
        // Reading progress indicator
        function updateReadingProgress() {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('readingProgress').style.width = scrolled + "%";
            document.getElementById('readingProgressText').textContent = Math.round(scrolled) + "% selesai";
        }
        
        // Generate table of contents
        function generateTOC() {
            const headings = document.querySelectorAll('.article-content h1, .article-content h2, .article-content h3');
            const tocList = document.getElementById('tocList');
            
            if (headings.length > 3) {
                headings.forEach((heading, index) => {
                    // Add ID if not exists
                    if (!heading.id) {
                        heading.id = 'heading-' + index;
                    }
                    
                    // Create TOC item
                    const li = document.createElement('li');
                    const a = document.createElement('a');
                    a.href = '#' + heading.id;
                    a.textContent = heading.textContent;
                    a.className = 'text-sm';
                    
                    // Indent based on heading level
                    if (heading.tagName === 'H2') {
                        a.className += ' ml-2';
                    } else if (heading.tagName === 'H3') {
                        a.className += ' ml-4';
                    }
                    
                    li.appendChild(a);
                    tocList.appendChild(li);
                });
                
                // Show TOC button
                document.querySelector('footer button').classList.remove('hidden');
            } else {
                document.querySelector('footer button').classList.add('hidden');
            }
        }
        
        // Toggle table of contents
        function toggleToc() {
            const toc = document.getElementById('tableOfContents');
            toc.style.display = toc.style.display === 'block' ? 'none' : 'block';
        }
        
        // Scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Initialize on load
        window.onload = function() {
            calculateReadingTime();
            generateTOC();
        };
        
        window.onscroll = function() {
            updateReadingProgress();
        };
        
        // Copy link function
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                Swal.fire({
                    title: 'Tersalin!',
                    text: 'Link artikel berhasil disalin.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, function(err) {
                Swal.fire({
                    title: 'Gagal Menyalin',
                    text: 'Maaf, terjadi kesalahan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    </script>
</body>
</html>