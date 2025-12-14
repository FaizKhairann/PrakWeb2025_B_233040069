<x-layout>
  <x-slot:title>Login</x-slot:title>

  <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold mb-4 text-center">Login</h1>

    @if(session('success'))
    <p class="text-green-600 text-center mb-4">{{ session('success') }}</p>
    @endif

    @if(session('error'))
    <p class="text-red-600 text-center mb-4">{{ session('error') }}</p>
    @endif

    <form action="/login" method="POST" class="space-y-4">
      @csrf

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

      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
        Login
      </button>
    </form>

    <p class="mt-4 text-center">
      Belum punya akun?
      <a href="/register" class="text-blue-600 font-semibold underline">Register</a>
    </p>
  </div>
</x-layout>