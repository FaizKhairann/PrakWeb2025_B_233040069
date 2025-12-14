<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Tambahan slot baru dengan nama $title --}}
    <title>{{ $title ?? 'Dashboard' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- flowbite --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    {{-- Font Inter --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-gray-800 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            {{-- Logo / Brand --}}
            <a href="/" class="text-white text-lg font-bold hover:text-gray-300">
                Latihan Dashboard
            </a>

            {{-- Menu Links --}}
            <div class="flex items-center space-x-4">

                {{-- Link Balik ke Home --}}
                <a href="/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">
                    Home
                </a>

                {{-- LOGIKA AUTH (Hanya muncul kalau login) --}}
                @auth
                <div class="flex items-center gap-2 border-l border-gray-600 pl-4 ml-2">
                    <span class="text-white text-sm mr-2">Hi, {{ auth()->user()->name }}</span>

                    {{-- MENU 1: MY POSTS (Dashboard Index) --}}
                    <a href="{{ route('dashboard.index') }}"
                        class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('dashboard.*') ? 'bg-gray-900 text-white' : '' }}">
                        My Posts
                    </a>

                    {{-- MENU 2: POST CATEGORIES (TUGAS YANG DIMINTA) --}}
                    <a href="{{ route('categories.index') }}"
                        class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('categories.*') ? 'bg-gray-900 text-white' : '' }}">
                        Post Categories
                    </a>

                    {{-- TOMBOL LOGOUT --}}
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-red-700 transition ml-2">
                            Logout
                        </button>
                    </form>
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