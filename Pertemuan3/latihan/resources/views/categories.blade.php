<x-layout>
  <x-slot:title>Halaman Kategori</x-slot:title>

  <h1 class="text-xl font-bold mb-4">Daftar Kategori</h1>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($categories as $category)
    <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-50">
      <a href="/categories/{{ $category->slug }}">
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
          {{ $category->name }}
        </h2>
      </a>
    </article>
    @endforeach
  </div>

</x-layout>