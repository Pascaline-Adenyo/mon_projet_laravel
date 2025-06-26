<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Formulaire Visiteur</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0f2fe, #bae6fd, #7dd3fc);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
    }
    
    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    
    .form-container {
      transform: translateY(0);
      opacity: 0;
      animation: slideIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }
    
    @keyframes slideIn {
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }
    
    .input-focus {
      transition: all 0.3s ease;
      box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
    }
    
    .input-focus:focus {
      box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.4);
      border-color: #0ea5e9;
    }
    
    .header-shadow {
      box-shadow: 0 4px 20px rgba(2, 132, 199, 0.1);
    }
    
    .btn-enregistrer {
      transition: all 0.3s ease;
      background: linear-gradient(135deg, #0ea5e9, #0284c7);
      box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
    }
    
    .btn-enregistrer:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
    }
    
    .btn-enregistrer:active {
      transform: translateY(1px);
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
    
    .form-card {
      backdrop-filter: blur(10px);
      box-shadow: 0 15px 35px rgba(2, 132, 199, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.4);
    }
    
    select, input {
      background-color: rgba(255, 255, 255, 0.7);
    }
  </style>
</head>
<body class="min-h-screen">

  <!-- En-tête -->
  <header class="bg-white bg-opacity-90 px-6 py-4 flex items-center justify-between header-shadow sticky top-0 z-10">
    <div class="flex items-center space-x-3">
      <div class="bg-white p-2 rounded-xl shadow-lg">
        <img src="https://www.neostart.tech/_nuxt/logo.DFn82Mk0.png" alt="Logo Neo Start" class="h-10 transition-transform duration-300 hover:scale-105">
      </div>
      <div>
        <h1 class="text-xl font-bold text-sky-800">Système de gestion des visiteurs</h1>
        <p class="text-sm text-sky-600">Formulaire des Locataires</p>
      </div>
    </div>
    <div class="flex space-x-4">
     
      <a href="{{ url('/accueil') }}" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-1 group-hover:underline">Ajouter visite</span>
        <i class="fas fa-home text-sky-600"></i>
      </a>
      <a href="{{ route('locataires.create') }}" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-1 group-hover:underline">Ajouter un locataire</span>
        <i class="fas fa-user-plus text-sky-600"></i>
      </a>
       <a href="{{ url('/visiteurs') }}" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-1 group-hover:underline">Liste des visiteurs</span>
        <i class="fas fa-list text-sky-600"></i>
      </a>
      <a href="{{ route('locataires.index') }}" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-1 group-hover:underline">Liste des locataires</span>
        <i class="fas fa-users text-sky-600"></i>
      </a>
    </div>
  </header>

  <!-- Contenu principal -->
  <div class="flex items-center justify-center py-10 px-4">
    <div class="bg-white bg-opacity-90 p-8 rounded-2xl w-full max-w-4xl text-gray-800 form-container form-card">
      <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-sky-800 section-title">ENREGISTREMENT LOCATAIRE</h2>
        <p class="mt-2 text-sky-600">Veuillez remplir tous les champs du formulaire</p>
      </div>

      <form class="space-y-6" action="{{ route('locataires.store') }}" method="POST">
        @csrf
               
        <!-- Ligne 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Nom</label>
            <input type="text" placeholder="Nom du locataire" name="nom" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Prénom</label>
            <input type="text" placeholder="Prénom du locataire" name="prenom" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
        </div>

        <!-- Ligne 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Email</label>
            <input type="text" placeholder="email" name="email" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Telephone</label>
            <input type="text" placeholder="telephone" name="telephone" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
        </div>

        <!-- Ligne 3 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Appartement</label>
            <input type="text" placeholder="Numero Appartement" name="appartement" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Etage</label>
            <input type="text" placeholder="Etage" name="etage" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
        </div>

        <!-- Ligne 4 -->
        <div class="grid grid-cols-1 md:grid-cols-1 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Actif</label>
            <input type="text" name="actif" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
         
        </div>

      

        <!-- Bouton -->
        <div class="text-center mt-8">
          <button type="submit" class="btn-enregistrer text-white font-bold py-3 px-8 rounded-full text-lg">
            <i class="fas fa-save mr-2"></i>ENREGISTRER
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Pied de page -->
  <footer class="py-6 bg-white bg-opacity-80 text-center text-sky-700 mt-auto">
    <div class="container mx-auto px-4">
      <p class="mb-2">Système de gestion des visiteurs Neo Start</p>
      <p class="text-sm">© 2023 Tous droits réservés</p>
    </div>
  </footer>
</body>
</html>