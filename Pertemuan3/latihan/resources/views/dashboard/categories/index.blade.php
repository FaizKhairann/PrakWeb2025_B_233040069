<x-dashboard-layout>
  <x-slot:title>Post Categories</x-slot:title>

  <div class="max-w-4xl mx-auto">
    {{-- Header & Tombol Tambah --}}
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Post Categories</h1>
      <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        Create New Category
      </a>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
      <span class="font-medium">Success!</span> {{ session('success') }}
    </div>
    @endif

    {{-- Tabel Kategori --}}
    <div class="relative overflow-x-auto bg-white shadow-md sm:rounded-lg border border-gray-200">
      <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
          <tr>
            <th scope="col" class="px-6 py-3 w-10">No</th>
            <th scope="col" class="px-6 py-3">Category Name</th>
            <th scope="col" class="px-6 py-3">Slug</th>
            <th scope="col" class="px-6 py-3 w-48">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr class="bg-white border-b hover:bg-gray-50">
            {{-- Nomor Urut --}}
            <td class="px-6 py-4 font-medium text-gray-900">
              {{ $loop->iteration }}
            </td>

            {{-- Nama Kategori --}}
            <td class="px-6 py-4 font-semibold text-gray-800">
              {{ $category->name }}
            </td>

            {{-- Slug --}}
            <td class="px-6 py-4 text-gray-500 italic">
              {{ $category->slug }}
            </td>

            {{-- Tombol Aksi --}}
            <td class="px-6 py-4">
              <div class="flex gap-3">
                {{-- Edit --}}
                <a href="{{ route('categories.edit', $category->slug) }}" class="font-medium text-yellow-500 hover:underline">
                  Edit
                </a>

                {{-- Delete --}}
                <form action="{{ route('categories.destroy', $category->slug) }}" method="post" class="inline">
                  @method('delete')
                  @csrf
                  <button class="font-medium text-red-600 hover:underline" onclick="return confirm('Yakin mau di hapus?')">
                    Delete
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-dashboard-layout>