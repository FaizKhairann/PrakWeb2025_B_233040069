<x-layout>
  <x-slot:title>Halaman Blog</x-slot:title>

  <h1 class="text-xl font-bold mb-4">Daftar Posts</h1>

  @foreach ($posts as $post)
  <article class="mb-5 border-b border-gray-200 pb-4">
    <h2>
      <a href="/posts/{{ $post->slug }}" class="hover:underline text-blue-500 text-3xl font-bold">
        {{ $post->title }}
      </a>
    </h2>

    <div class="text-base text-gray-500">
      <a href="#">{{ $post->user->name }}</a> | {{ $post->created_at->diffForHumans() }}
    </div>

    <p class="my-4 font-light">{{ $post->excerpt }}</p>

    <a href="/posts/{{ $post->slug }}" class="font-medium text-blue-500 hover:underline"></a>
  </article>
  @endforeach

</x-layout>