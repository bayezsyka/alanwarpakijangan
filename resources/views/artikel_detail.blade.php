<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ htmlspecialchars($article['judul']) }} - Pesantren Al-Anwar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col">
    <main class="flex-grow container mx-auto max-w-4xl px-4 py-8">
        <article class="bg-white rounded-lg shadow-lg overflow-hidden p-6 sm:p-8">
            <img src="{{ htmlspecialchars($article['gambar']) }}" alt="{{ htmlspecialchars($article['judul']) }}" class="w-full h-64 object-cover rounded-md mb-6">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ htmlspecialchars($article['judul']) }}</h1>
            <div class="flex items-center text-gray-600 text-sm mb-6">
                <span class="mr-4">Tanggal: {{ date("d M Y", strtotime($article['tanggal'])) }}</span>
                <span>Oleh: {{ htmlspecialchars($article['penulis']) }}</span>
            </div>
            <div class="prose max-w-none text-gray-800 leading-relaxed text-base sm:text-lg">
                <p>{!! nl2br(htmlspecialchars($article['isi'])) !!}</p>
            </div>
            <div class="mt-8">
                <a href="{{ route('artikel') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Artikel
                </a>
            </div>
        </article>
    </main>
</body>
</html>