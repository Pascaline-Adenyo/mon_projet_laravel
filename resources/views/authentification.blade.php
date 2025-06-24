<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-sky-100 to-sky-300 min-h-screen flex items-center justify-center">

  <div class="bg-white bg-opacity-30 backdrop-blur-md p-8 rounded-xl shadow-lg w-full max-w-md">
    <h2 class="text-gray-800 text-2xl font-bold text-center mb-6">Login</h2>

    @if(session('error'))
      <p class="text-red-600 text-center mb-4">{{ session('error') }}</p>
    @endif

    <form action="{{ route('login.custom') }}" method="POST" class="space-y-4">
      @csrf

      <div class="relative">
        <span class="absolute left-3 top-3 text-yellow-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5.121 17.804A8.003 8.003 0 0112 4a8.003 8.003 0 016.879 13.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </span>
        <input type="email" name="email" placeholder="Email"
               class="w-full pl-10 pr-4 py-2 rounded-md bg-white bg-opacity-60 text-gray-800 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-sky-400" />
        @error('email')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="relative">
        <span class="absolute left-3 top-3 text-yellow-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3m6 0a3 3 0 00-6 0v2a3 3 0 006 0v-2zm0 0v2m0 4h.01M4 11v6a2 2 0 002 2h12a2 2 0 002-2v-6" />
          </svg>
        </span>
        <input type="password" name="password" placeholder="Password"
               class="w-full pl-10 pr-4 py-2 rounded-md bg-white bg-opacity-60 text-gray-800 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-sky-400" />
        @error('password')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit"
              class="w-full bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 rounded-md transition-all">
        LOGIN
      </button>
    </form>

    <div class="text-center mt-4">
      <a href="#" class="text-gray-700 text-sm hover:underline">Forgot your password?</a>
    </div>

    <div class="text-center mt-6">
      <span class="text-gray-700 text-sm">New here?</span>
      <a href="#" class="text-sky-700 font-semibold hover:underline">Sign Up</a>
    </div>
  </div>
</body>
</html>
