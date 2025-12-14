<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Judul Halaman Dinamis --}}
    <title>{{ $title ?? 'Latihan Laravel' }}</title>

    {{-- PENTING: Memanggil CSS & JS (Pastikan npm run dev jalan) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Inter (Opsional, biar fontnya bagus) --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
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
            <div class="flex items-center space-x-4">
                {{-- Menu Umum --}}
                <a href="/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Home</a>
                <a href="/about" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">About</a>
                <a href="/blog" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Blog</a>
                <a href="/contact" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Contact</a>
                <a href="/categories" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Categories</a>

                {{-- LOGIKA AUTH (LOGIN / LOGOUT) --}}
                @auth
                {{-- TAMPILAN JIKA SUDAH LOGIN --}}
                <div class="flex items-center gap-2 border-l border-gray-600 pl-4 ml-2">
                    {{-- Nama User --}}
                    <span class="text-white text-sm font-semibold mr-2">Hi, {{ auth()->user()->name }}</span>

                    {{-- Tombol Dashboard --}}
                    <a href="{{ route('dashboard.index') }}" class="bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">
                        Dashboard
                    </a>

                    {{-- Tombol Logout (Wajib Form) --}}
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-red-700 transition">
                            Logout
                        </button>
                    </form>
                </div>
                @else
                {{-- TAMPILAN JIKA BELUM LOGIN (GUEST) --}}
                <div class="flex items-center gap-2 border-l border-gray-600 pl-4 ml-2">
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-gray-700 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-600 transition">
                        Register
                    </a>
                </div>
                @endauth
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