<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historique des Visites</title>
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
      display: flex;
      flex-direction: column;
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
    
    .badge-en-cours {
      background-color: #fef3c7;
      color: #d97706;
    }
    
    .badge-termine {
      background-color: #d1fae5;
      color: #047857;
    }
    
    .back-btn {
      background: linear-gradient(135deg, #38bdf8, #0ea5e9);
      color: white;
      padding: 0.6rem 1.2rem;
      border-radius: 0.75rem;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(2, 132, 199, 0.2);
      font-weight: 500;
      margin-bottom: 1.5rem;
    }
    
    .back-btn:hover {
      background: linear-gradient(135deg, #0ea5e9, #0284c7);
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(2, 132, 199, 0.3);
    }
    
    .back-btn:active {
      transform: translateY(0);
    }
    
    .locataire-card {
      background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(2, 132, 199, 0.08));
      border-radius: 1rem;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 10px 25px rgba(2, 132, 199, 0.1);
      border: 1px solid rgba(2, 132, 199, 0.15);
    }
    
    .locataire-info {
      display: flex;
      flex-wrap: wrap;
      gap: 1.5rem;
    }
    
    .info-item {
      display: flex;
      flex-direction: column;
    }
    
    .info-label {
      font-size: 0.75rem;
      color: #0c4a6e;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      font-weight: 600;
      margin-bottom: 0.25rem;
    }
    
    .info-value {
      font-size: 1rem;
      font-weight: 500;
      color: #0369a1;
    }
  </style>
</head>

<body>
  <header class="bg-white bg-opacity-90 px-6 py-4 flex items-center justify-between header-shadow sticky top-0 z-10">
    <div class="flex items-center space-x-3">
      <div class="bg-white p-2 rounded-xl shadow-lg">
        <img src="https://www.neostart.tech/_nuxt/logo.DFn82Mk0.png" alt="Logo Neo Start" class="h-10 transition-transform duration-300 hover:scale-105">
      </div>
      <div>
        <h1 class="text-xl font-bold text-sky-800">Système de gestion des visiteurs</h1>
        <p class="text-sm text-sky-600">Historique des visites</p>
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

  <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex-1">
    <div class="table-container card-shadow">
      <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-sky-50 bg-opacity-50">
        <div>
          <h1 class="text-2xl font-bold text-sky-800 section-title">Historique des Visites</h1>
          <p class="text-sm text-sky-600 mt-2">Suivi des visites pour le locataire</p>
        </div>
        <a href="{{ route('locataires.index') }}" class="back-btn">
          <i class="fas fa-arrow-left"></i>
          Retour aux locataires
        </a>
      </div>

      <div class="px-6 py-4">
        <div class="locataire-card">
          <div class="locataire-info">
             <div class="info-item">
  <span class="info-label">Profil</span>
  @if($locataire->photo)
    <img src="{{ asset('storage/' . $locataire->photo) }}" 
         alt="Photo de profil"
         class="w-16 h-16 rounded-full object-cover border border-sky-300 shadow mt-1">
  @else
    <div class="w-16 h-16 rounded-full bg-sky-100 flex items-center justify-center
                text-sky-700 font-semibold text-base border border-sky-300 shadow mt-1">
      {{ strtoupper(substr($locataire->nom, 0, 1)) }}
    </div>
  @endif
</div>


            <div class="info-item">
              <span class="info-label">Nom</span>
              <span class="info-value">{{ $locataire->nom }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Prénom</span>
              <span class="info-value">{{ $locataire->prenom }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Email</span>
              <span class="info-value">{{ $locataire->email }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Téléphone</span>
              <span class="info-value">{{ $locataire->telephone }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Appartement</span>
              <span class="info-value">{{ $locataire->appartement }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Étage</span>
              <span class="info-value">{{ $locataire->etage }}</span>
            </div>
            <div class="info-item">
              <span class="info-label">Statut</span>
              <span class="info-value">
                @if($locataire->actif)
                  <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs">Actif</span>
                @else
                  <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs">Inactif</span>
                @endif
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Profil</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Visiteur</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Téléphone</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Pièce d'identité</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Motif</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Heure entrée</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Heure sortie</th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-medium tracking-wider table-header">Statut</th>
            </tr>
          </thead>
          <tbody>
            @foreach($locataire->visites as $visite)
            <tr class="table-row">
     <td class="px-6 py-4 whitespace-nowrap">
  @if($visite->photo)
    <img src="{{ asset('storage/' . $visite->photo) }}" alt="Photo" class="w-10 h-10 rounded-full object-cover border border-sky-300 shadow-md">
  @else
    <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-500 font-bold">
      {{ strtoupper(substr($visite->visiteur_nom, 0, 1)) }}
    </div>
  @endif
</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-sky-800">
                {{ $visite->visiteur_prenom }} {{ $visite->visiteur_nom }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-700">
                {{ $visite->visiteur_telephone }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-600">
                <span class="font-medium">{{ $visite->visiteur_piece_identite }}:</span> 
                {{ $visite->visiteur_numero_piece }}
              </td>
              <td class="px-6 py-4 text-sm text-sky-600">
                {{ $visite->motif_visite }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-600">
                {{ \Carbon\Carbon::parse($visite->heure_entree)->format('d/m/Y H:i') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-sky-600">
                @if($visite->heure_sortie)
                  {{ \Carbon\Carbon::parse($visite->heure_sortie)->format('d/m/Y H:i') }}
                @else
                  <span class="text-red-500 font-medium">En cours</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if($visite->statut === 'en_cours')
                  <span class="badge-en-cours px-2 py-1 rounded-full text-xs font-medium">En cours</span>
                @elseif($visite->statut === 'termine')
                  <span class="badge-termine px-2 py-1 rounded-full text-xs font-medium">Terminé</span>
                @else
                  <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-medium">{{ $visite->statut }}</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4 bg-sky-50 bg-opacity-50">
        <div class="text-sm text-sky-700">
          <i class="fas fa-history mr-2"></i>Historique de <span class="font-bold">{{ count($locataire->visites) }}</span> visites
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