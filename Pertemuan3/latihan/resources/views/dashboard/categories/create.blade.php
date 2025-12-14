<x-dashboard-layout>
  <x-slot:title>Create Category</x-slot:title>

  <div class="max-w-2xl mx-auto">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Create New Category</h1>
    </div>

    <div class="relative bg-white border border-gray-200 rounded-lg shadow-sm p-6">
      <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        {{-- Input Name --}}
        <div class="mb-6">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Category Name</label>
          <input type="text" name="name" id="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Masukan Category" required autofocus>
          @error('name')
          <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex items-center gap-4">
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
            Create Category
          </button>
          <a href="{{ route('categories.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</x-dashboard-layout>