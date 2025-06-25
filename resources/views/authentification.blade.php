
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion - Système de Gestion</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0f2fe, #bae6fd, #7dd3fc);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      min-height: 100vh;
    }
    
    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    
    .login-card {
      box-shadow: 0 20px 40px rgba(2, 132, 199, 0.15);
      border-radius: 1rem;
      overflow: hidden;
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.88);
      border: 1px solid rgba(255, 255, 255, 0.5);
    }
    
    .action-button {
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(2, 132, 199, 0.15);
      border-radius: 0.75rem;
    }
    
    .action-button:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(2, 132, 199, 0.25);
    }
    
    .action-button:active {
      transform: translateY(1px);
    }
    
    .search-input {
      transition: all 0.3s ease;
      border-radius: 0.75rem;
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(5px);
      border: 1px solid rgba(203, 213, 225, 0.4);
    }
    
    .search-input:focus {
      box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.3);
      border-color: #0ea5e9;
    }
    
    .section-title {
      position: relative;
      display: inline-block;
      padding-bottom: 8px;
    }
    
    .section-title::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, #0ea5e9, #0284c7);
      border-radius: 2px;
    }
    
    .header-shadow {
      box-shadow: 0 4px 20px rgba(2, 132, 199, 0.1);
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.9);
    }
    
    .success-alert {
      background: rgba(220, 252, 231, 0.8);
      border-left: 4px solid #10b981;
      backdrop-filter: blur(5px);
    }
    
    input:focus {
      box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.3);
    }
    
    input::placeholder {
      transition: all 0.3s ease;
    }
    
    input:focus::placeholder {
      transform: translateX(5px);
      opacity: 0.7;
    }
  </style>
</head>
<body>
  <header class="bg-white bg-opacity-90 px-6 py-4 flex items-center justify-between header-shadow sticky top-0 z-10">
    <div class="flex items-center space-x-3">
      <div class="bg-white p-2 rounded-xl shadow-lg">
        <img src="https://www.neostart.tech/_nuxt/logo.DFn82Mk0.png" alt="Logo Neo Start" class="h-12 transition-transform duration-300 hover:scale-105">
      </div>
      <div>
        <h1 class="text-xl font-bold text-sky-800">Système de gestion des visiteurs</h1>
        <p class="text-sm text-sky-600">Interface d'authentification</p>
      </div>
    </div>
    <div class="flex space-x-4">
      <a href="#" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-2 group-hover:underline">Connexion</span>
        <i class="fas fa-user text-sky-600"></i>
      </a>
      <a href="#" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-2 group-hover:underline">Inscription</span>
        <i class="fas fa-user-plus text-sky-600"></i>
      </a>
    </div>
  </header>

  <main class="max-w-md mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="login-card">
      <div class="px-6 py-5 border-b border-gray-100 bg-sky-50 bg-opacity-50">
        <div class="text-center">
          <h1 class="text-2xl font-bold text-sky-800 section-title">Connexion</h1>
          <p class="text-sm text-sky-600 mt-2">Accédez à votre espace administrateur</p>
        </div>
      </div>

      @if(session('error'))
        <div class="success-alert p-4 mx-6 mt-4 rounded-md">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <i class="fas fa-exclamation-circle text-red-600"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm text-red-800 font-medium">{{ session('error') }}</p>
            </div>
          </div>
        </div>
      @endif

      <div class="p-6">
        <form action="{{ route('login.custom') }}" method="POST" class="space-y-4">
          @csrf

          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-envelope text-sky-500"></i>
            </div>
            <input type="email" name="email" placeholder="Adresse email"
                   class="w-full pl-10 pr-4 py-2.5 rounded-xl focus:ring-0 outline-none search-input" />
            @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-lock text-sky-500"></i>
            </div>
            <input type="password" name="password" placeholder="Mot de passe"
                   class="w-full pl-10 pr-4 py-2.5 rounded-xl focus:ring-0 outline-none search-input" />
            @error('password')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input id="remember" type="checkbox" class="h-4 w-4 text-sky-500 focus:ring-sky-400 border-gray-300 rounded">
              <label for="remember" class="ml-2 block text-sm text-gray-700">
                Se souvenir de moi
              </label>
            </div>
            <a href="#" class="text-sm text-sky-700 hover:underline">Mot de passe oublié?</a>
          </div>

          <button type="submit"
                  class="w-full bg-gradient-to-r from-sky-500 to-sky-600 hover:from-sky-600 hover:to-sky-700 text-white font-bold py-2.5 rounded-xl action-button transition-all">
            <i class="fas fa-sign-in-alt mr-2"></i>CONNEXION
          </button>
        </form>

        <div class="relative flex py-5 items-center mt-6">
          <div class="flex-grow border-t border-gray-300 border-opacity-50"></div>
          <span class="flex-shrink mx-4 text-gray-600 text-sm">Ou continuer avec</span>
          <div class="flex-grow border-t border-gray-300 border-opacity-50"></div>
        </div>

        <div class="flex justify-center space-x-4 mt-4">
          <button class="w-12 h-12 rounded-full bg-white bg-opacity-60 flex items-center justify-center text-sky-500 hover:bg-sky-100 transition-all action-button">
            <i class="fab fa-google"></i>
          </button>
          <button class="w-12 h-12 rounded-full bg-white bg-opacity-60 flex items-center justify-center text-sky-500 hover:bg-sky-100 transition-all action-button">
            <i class="fab fa-microsoft"></i>
          </button>
          <button class="w-12 h-12 rounded-full bg-white bg-opacity-60 flex items-center justify-center text-sky-500 hover:bg-sky-100 transition-all action-button">
            <i class="fab fa-apple"></i>
          </button>
        </div>

        <div class="text-center mt-8">
          <span class="text-gray-700 text-sm">Vous n'avez pas de compte?</span>
          <a href="#" class="text-sky-700 font-semibold hover:underline ml-2">Créer un compte</a>
        </div>
      </div>
    </div>
  </main>
  
  <!-- Pied de page -->
  <footer class="py-6 bg-white bg-opacity-80 text-center text-sky-700 mt-8">
    <div class="container mx-auto px-4">
      <p class="mb-2">Système de gestion des visiteurs Neo Start</p>
      <p class="text-sm">© 2023 Tous droits réservés</p>
    </div>
  </footer>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('form');
      form.classList.add('opacity-0', 'transform', '-translate-y-4');
      
      setTimeout(() => {
        form.classList.add('transition-all', 'duration-500', 'ease-out');
        form.classList.remove('opacity-0', '-translate-y-4');
      }, 100);
    });
  </script>
</body>
</html>