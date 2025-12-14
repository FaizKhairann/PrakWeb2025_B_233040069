<x-layout>
  <x-slot:title>Register</x-slot:title>

  <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold mb-4 text-center">Register</h1>

    @if ($errors->any())
    <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    @if(session('error'))
    <p class="text-red-600 text-center mb-4">{{ session('error') }}</p>
    @endif

    <form action="/register" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block font-semibold">Nama</label>
        <input type="text" name="name"
          class="border w-full p-2 rounded focus:ring focus:ring-blue-300"
          required>
      </div>

      <div>
        <label class="block font-semibold">Email</label>
        <input type="email" name="email"
          class="border w-full p-2 rounded focus:ring focus:ring-blue-300"
          required>
      </div>

      <div>
        <label class="block font-semibold">Password</label>
        <input type="password" name="password"
          class="border w-full p-2 rounded focus:ring focus:ring-blue-300"
          required>
      </div>

      <div>
        <label class="block font-semibold">Konfirmasi Password</label>
        <input type="password" name="password_confirmation"
          class="border w-full p-2 rounded focus:ring focus:ring-blue-300"
          required>
      </div>

      <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
        Register
      </button>
    </form>

    <p class="mt-4 text-center">
      Sudah punya akun?
      <a href="/login" class="text-blue-600 font-semibold underline">Login</a>
    </p>
  </div>
</x-layout>