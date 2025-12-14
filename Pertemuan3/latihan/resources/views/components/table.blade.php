<div class="flex justify-between items-center mb-4">

  {{-- Search --}}
  <form action="{{ route('dashboard.index') }}" method="GET" class="flex gap-2">
    <input
      type="text"
      name="search"
      placeholder="Search posts..."
      value="{{ request('search') }}"
      class="border rounded px-3 py-2">
    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
      Search
    </button>
  </form>

  {{-- Add Post Button --}}
  <a href="{{ route('dashboard.create') }}"
    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    Add Post
  </a>

</div>

{{-- TABLE --}}
<div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
  <table class="w-full text-sm text-left rtl:text-right text-body">
    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
      <tr>
        <th scope="col" class="px-6 py-3 font-medium">
          No
        </th>
        <th scope="col" class="px-6 py-3 font-medium">
          Image
        </th>
        <th scope="col" class="px-6 py-3 font-medium">
          Title
        </th>
        <th scope="col" class="px-6 py-3 font-medium">
          Category
        </th>
        <th scope="col" class="px-6 py-3 font-medium">
          Published At
        </th>
        <th scope="col" class="px-6 py-3 font-medium">
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
      @forelse($posts as $post)
      <tr class="bg-neutral-primary border-b border-default">

        {{-- KOLOM 1: NO --}}
        <td class="px-6 py-4">
          {{ $posts->firstItem() + $loop->index }}
        </td>

        {{-- KOLOM 2: IMAGE (Wajib ada biar gak geser) --}}
        <td class="px-6 py-4">
          @if ($post->image)
          <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-16 h-16 rounded object-cover">
          @else
          {{-- Pastikan ada file preview.jpg di public/images/, kalau gak ada ganti src-nya jadi link gambar placeholder --}}
          <img src="{{ asset('images/preview.jpg') }}" alt="No Image" class="w-16 h-16 rounded object-cover bg-gray-100">
          @endif
        </td>

        {{-- KOLOM 3: TITLE --}}
        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
          {{ $post->title }}
        </th>

        {{-- KOLOM 4: CATEGORY --}}
        <td class="px-6 py-4">
          {{ $post->category->name ?? 'Uncategorized' }}
        </td>

        {{-- KOLOM 5: PUBLISHED AT --}}
        <td class="px-6 py-4">
          {{ $post->created_at->format('d M Y') }}
        </td>

        {{-- KOLOM 6: ACTIONS (View, Edit, Delete) --}}
        <td class="px-6 py-4">
          <div class="flex items-center gap-3">
            {{-- View --}}
            <a href="{{ route('dashboard.show', $post->slug) }}" class="text-blue-600 hover:underline">View</a>

            {{-- Edit --}}
            <a href="{{ route('dashboard.edit', $post->slug) }}" class="text-yellow-500 hover:underline">Edit</a>

            {{-- Delete --}}
            <form action="{{ route('dashboard.destroy', $post->slug) }}" method="POST" class="inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus postingan ini?')">
                Delete
              </button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
          Tidak ada Post <a href="{{ route('dashboard.create') }}" class="text-blue-600 hover:underline">Buat disini!</a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>


{{-- PAGINATION FLOWBITE   --}}

@if ($posts->hasPages())
<div class="px-6 py-4 border-t border-gray-200">
  <nav aria-label="Page navigation">
    <ul class="flex space-x-px text-sm">

      {{-- Previous Button --}}
      @if ($posts->onFirstPage())
      <li>
        <span class="flex items-center justify-center text-body bg-neutral-primary-soft border border-default-medium rounded-e-base px-3 h-10 cursor-not-allowed">
          Previous
        </span>
      </li>
      @else
      <li>
        <a href="{{ $posts->previousPageUrl() }}"
          class="flex items-center justify-center text-body bg-neutral-tertiary-medium border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading font-medium rounded-e-base px-3 h-10 focus:outline-none">
          Previous
        </a>
      </li>
      @endif

      {{-- Page Numbers --}}
      @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
      @if ($page == $posts->currentPage())
      <li>
        <a href="{{ $url }}" aria-current="page"
          class="flex items-center justify-center text-heading bg-neutral-tertiary-medium border border-default-medium font-medium text-sm w-10 h-10 focus:outline-none">
          {{ $page }}
        </a>
      </li>
      @else
      <li>
        <a href="{{ $url }}"
          class="flex items-center justify-center text-body bg-neutral-secondary-medium border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading text-sm w-10 h-10 focus:outline-none">
          {{ $page }}
        </a>
      </li>
      @endif
      @endforeach

      {{-- Next Button --}}
      @if ($posts->hasMorePages())
      <li>
        <a href="{{ $posts->nextPageUrl() }}"
          class="flex items-center justify-center text-body bg-neutral-tertiary-medium border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading font-medium rounded-e-base px-3 h-10 focus:outline-none">
          Next
        </a>
      </li>
      @else
      <li>
        <span class="flex items-center justify-center text-body bg-neutral-primary-soft border border-default-medium rounded-e-base px-3 h-10 cursor-not-allowed">
          Next
        </span>
      </li>
      @endif

    </ul>
  </nav>
</div>
@endif