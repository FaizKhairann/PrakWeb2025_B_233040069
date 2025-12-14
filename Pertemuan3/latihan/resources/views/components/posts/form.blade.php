@props(['categories', 'post' => null])

{{-- Action Form Dinamis: Kalau ada $post berarti Update, kalau gak ada berarti Store --}}
<form action="{{ $post ? route('dashboard.update', $post->slug) : route('dashboard.store') }}"
  method="POST" enctype="multipart/form-data">
  @csrf
  {{-- Kalau Edit, tambahkan method PUT --}}
  @if($post)
  @method('PUT')
  @endif

  <div class="grid gap-4 grid-cols-2">
    {{-- Title --}}
    <div class="col-span-2">
      <label for="title" class="block mb-2.5 text-sm font-medium text-heading">Title</label>
      <input type="text" name="title" id="title"
        value="{{ old('title', $post->title ?? '') }}"
        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand w-full px-3 py-2.5 shadow-xs placeholder:text-body">
      @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Slug (Otomatis generate di controller, tapi input ini perlu ada buat passing data slug lama pas edit) --}}
    <div class="col-span-2">
      <label for="slug" class="block mb-2.5 text-sm font-medium text-heading">Slug</label>
      <input type="text" name="slug" id="slug"
        value="{{ old('slug', $post->slug ?? '') }}"
        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand w-full px-3 py-2.5 shadow-xs placeholder:text-body">
      @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Category --}}
    <div class="col-span-2">
      <label for="category_id" class="block mb-2.5 text-sm font-medium text-heading">Category</label>
      <select name="category_id" id="category_id"
        class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand placeholder:text-body">
        <option value="">Select category</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}"
          {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
          {{ $category->name }}
        </option>
        @endforeach
      </select>
      @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Excerpt --}}
    <div class="col-span-2">
      <label for="excerpt" class="block mb-2.5 text-sm font-medium text-heading">Excerpt</label>
      <textarea name="excerpt" id="excerpt" rows="3"
        class="block bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand w-full px-3 py-2.5 shadow-xs placeholder:text-body">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
      @error('excerpt') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Body --}}
    <div class="col-span-2">
      <label for="body" class="block mb-2.5 text-sm font-medium text-heading">Content</label>
      <textarea name="body" id="body" rows="8"
        class="block bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand w-full px-3 py-3.5 shadow-xs placeholder:text-body">{{ old('body', $post->body ?? '') }}</textarea>
      @error('body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- Image --}}
    <div class="col-span-2">
      {{-- Input Hidden buat simpan gambar lama --}}
      <input type="hidden" name="oldImage" value="{{ $post->image ?? '' }}">
      <label for="image" class="block mb-2.5 text-sm font-medium text-heading">Upload Image</label>
      {{-- Preview Gambar Lama --}}
      @if($post && $post->image)
      <img src="{{ asset('storage/' . $post->image) }}" class="mb-2 w-32 h-auto rounded">
      @endif
      <input type="file" name="image" id="image" class="cursor-pointer bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base block w-full shadow-xs">
      @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
  </div>

  {{-- Footer --}}
  <div class="flex items-center space-x-4 border-t border-default pt-4 mt-4">
    <button type="submit" class="text-white bg-brand hover:bg-brand-strong rounded-base text-sm px-4 py-2.5">
      {{ $post ? 'Update Post' : 'Create Post' }}
    </button>
    <a href="{{ route('dashboard.index') }}" class="text-body bg-neutral-secondary-medium border border-default-medium hover:bg-neutral-tertiary-medium rounded-base text-sm px-4 py-2.5">Cancel</a>
  </div>
</form>