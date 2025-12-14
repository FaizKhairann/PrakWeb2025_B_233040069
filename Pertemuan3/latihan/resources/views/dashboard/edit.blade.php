<x-dashboard-layout>
  <x-slot:title>Edit Post - Dashboard</x-slot:title>

  <div class="max-w-2xl mx-auto">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Post</h1>
    </div>

    <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
      {{-- Panggil Form Component & Kirim Data Post --}}
      <x-posts.form :categories="$categories" :post="$post" />
    </div>
  </div>
</x-dashboard-layout>