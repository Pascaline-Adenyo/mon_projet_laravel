<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Visiteurs</title>
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
    
    .table-container {
      box-shadow: 0 20px 40px rgba(2, 132, 199, 0.15);
      border-radius: 1rem;
      overflow: hidden;
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.88);
      border: 1px solid rgba(255, 255, 255, 0.5);
    }
    
    .status-badge {
      padding: 0.35rem 0.9rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 0.025em;
      transition: all 0.3s ease;
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
    
    .table-header {
      background: linear-gradient(135deg, #0ea5e9, #0284c7);
      color: white;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      font-size: 0.75rem;
    }
    
    .table-row {
      transition: all 0.3s ease;
      border-bottom: 1px solid rgba(203, 213, 225, 0.3);
    }
    
    .table-row:hover {
      background-color: rgba(224, 242, 254, 0.4);
      transform: translateY(-1px);
    }
    
    .search-input {
      transition: all 0.3s ease;
      min-width: 300px;
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
    
    .pagination-btn {
      transition: all 0.3s ease;
      border-radius: 0.75rem;
      background: rgba(255, 255, 255, 0.7);
      border: 1px solid rgba(203, 213, 225, 0.4);
    }
    
    .pagination-btn:hover {
      background: rgba(224, 242, 254, 0.4);
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(2, 132, 199, 0.15);
    }
    
    .card-shadow {
      box-shadow: 0 15px 35px rgba(2, 132, 199, 0.2);
    }
    
    .success-alert {
      background: rgba(220, 252, 231, 0.8);
      border-left: 4px solid #10b981;
      backdrop-filter: blur(5px);
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
        <p class="text-sm text-sky-600">Liste des visiteurs</p>
      </div>
    </div>
    <div class="flex space-x-4">
      <a href="{{ url('/visiteurs') }}" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-2 group-hover:underline">Liste des visiteurs</span>
        <i class="fas fa-list text-sky-600"></i>
      </a>
      <a href="{{ url('/accueil') }}" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-2 group-hover:underline">Accueil</span>
        <i class="fas fa-home text-sky-600"></i>
      </a>
    </div>
  </header>

  <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="table-container card-shadow">
      <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-sky-50 bg-opacity-50">
        <div>
          <h1 class="text-2xl font-bold text-sky-800 section-title">Gestion des Visiteurs</h1>
          <p class="text-sm text-sky-600 mt-2">Suivi des visiteurs en temps réel</p>
        </div>
        <div class="relative w-full sm:w-auto">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-sky-500"></i>
          </div>
          <input type="text" placeholder="Rechercher un visiteur..." class="pl-10 pr-4 py-2.5 rounded-xl focus:ring-0 outline-none transition search-input w-full">
        </div>
      </div>

      @if(session('success'))
        <div class="success-alert p-4 mx-6 mt-4 rounded-md">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
            </div>
            <div class="ml-3">
              <p class="text-sm text-green-800 font-medium">{{ session('success') }}</p>
            </div>
          </div>
        </div>
      @endif

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Nom</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Prénom</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Téléphone</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Pièce</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">N° Pièce</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Motif</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Entrée</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Sortie</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Statut</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Locataire</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Observations</th>
              <th scope="col" class="px-6 py-4 text-right text-xs font-medium tracking-wider table-header">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($visiteurs as $visiteur)
            <tr class="table-row">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-sky-800">{{ $visiteur->visiteur_nom }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-700">{{ $visiteur->visiteur_prenom }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-600">{{ $visiteur->visiteur_telephone }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-600">{{ $visiteur->visiteur_piece_identite }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-600">{{ $visiteur->visiteur_numero_piece }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-600">{{ $visiteur->motif_visite }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-sky-700">{{ $visiteur->heure_entree }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-sky-700">{{ $visiteur->heure_sortie }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="status-badge 
                  {{ $visiteur->statut === 'En attente' ? 'bg-amber-100 text-amber-800' : 
                     ($visiteur->statut === 'validé' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800') }}">
                  {{ $visiteur->statut }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-600">{{ $visiteur->locataire->nom }} {{ $visiteur->locataire->prenom }}</td>
              <td class="px-6 py-4 text-sm text-sky-600 max-w-xs">{{ $visiteur->observations }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form action="{{ route('visiteurs.valider', $visiteur->id) }}" method="POST" onsubmit="return confirm('Valider cette visite ?')">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 px-4 py-2 font-medium action-button">
                    <i class="fas fa-check-circle mr-2"></i>Valider
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4 bg-sky-50 bg-opacity-50">
        <div class="text-sm text-sky-700">
          <i class="fas fa-users mr-2"></i>Affichage de <span class="font-bold">1</span> à <span class="font-bold">10</span> sur <span class="font-bold">{{ count($visiteurs) }}</span> résultats
        </div>
        <div class="flex space-x-2">
          <button class="px-4 py-2 text-sm font-medium text-sky-700 pagination-btn">
            <span class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Précédent
            </span>
          </button>
          <button class="px-4 py-2 text-sm font-medium text-sky-700 pagination-btn">
            <span class="flex items-center">
              Suivant
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </span>
          </button>
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
</body>
</html>