<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Tambahan slot baru dengan nama $title --}}
    <title>{{$title}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-gray-800 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            {{-- Logo / Brand --}}
            <a href="/" class="text-white text-lg font-bold hover:text-gray-300">
                Latihan
            </a>

            {{-- Menu Links --}}
            <div class="space-x-4">
                <a href="/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Home</a>
                <a href="/about" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">About</a>
                <a href="/blog" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Blog</a>
                <a href="/contact" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Contact</a>
                <a href="/categories" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Categories</a>
                <a href="/posts" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Daftar Post</a>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA (SLOT) --}}
    <main class="container mx-auto mt-6 px-4 flex-grow">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-800 text-white text-center p-4 mt-8">
        <p>&copy; 2025 Praktikum Web.</p>
    </footer>

</body>

</html>