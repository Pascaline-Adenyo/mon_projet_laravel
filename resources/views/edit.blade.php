<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier un visiteur</title>
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
    
    .form-container {
      box-shadow: 0 20px 40px rgba(2, 132, 199, 0.15);
      border-radius: 1rem;
      overflow: hidden;
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.92);
      border: 1px solid rgba(255, 255, 255, 0.5);
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
    
    .card-shadow {
      box-shadow: 0 15px 35px rgba(2, 132, 199, 0.2);
    }
    
    .input-focus:focus {
      box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.3);
      border-color: #0ea5e9;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, #0ea5e9, #0284c7);
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(2, 132, 199, 0.15);
    }
    
    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(2, 132, 199, 0.25);
      background: linear-gradient(135deg, #0284c7, #0ea5e9);
    }
    
    .btn-primary:active {
      transform: translateY(1px);
    }
    
    .btn-secondary {
      background: linear-gradient(135deg, #94a3b8, #64748b);
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(100, 116, 139, 0.15);
    }
    
    .btn-secondary:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(100, 116, 139, 0.25);
      background: linear-gradient(135deg, #64748b, #94a3b8);
    }
  </style>
</head>
<body>
  <header class="bg-white bg-opacity-90 px-6 py-4 flex items-center justify-between shadow-md sticky top-0 z-10">
    <div class="flex items-center space-x-3">
      <div class="bg-white p-2 rounded-xl shadow-lg">
        <img src="https://www.neostart.tech/_nuxt/logo.DFn82Mk0.png" alt="Logo Neo Start" class="h-10 transition-transform duration-300 hover:scale-105">
      </div>
      <div>
        <h1 class="text-xl font-bold text-sky-800">Système de gestion des visiteurs</h1>
        <p class="text-sm text-sky-600">Modification d'un visiteur</p>
      </div>
    </div>
    <div class="flex space-x-4">
      <a href="{{ url('/accueil') }}" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-1 group-hover:underline">Ajouter visite</span>
        <i class="fas fa-home text-sky-600"></i>
      </a>
      <a href="{{ route('locataires.create') }}" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-1 group-hover:underline">Ajouter locataire</span>
        <i class="fas fa-user-plus text-sky-600"></i>
      </a>
      <a href="{{ url('/visiteurs') }}" class="flex items-center text-sky-700 font-medium hover:text-sky-900 transition-colors group">
        <span class="mr-1 group-hover:underline">Liste visiteurs</span>
        <i class="fas fa-list text-sky-600"></i>
      </a>
    </div>
  </header>

  <main class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="form-container card-shadow">
      <div class="px-6 py-5 border-b border-gray-100 bg-sky-50 bg-opacity-50">
        <h1 class="text-2xl font-bold text-sky-800 section-title">Modifier le visiteur</h1>
        <p class="text-sm text-sky-600 mt-2">Mettez à jour les informations du visiteur</p>
      </div>
      
      <div class="p-6">
        @if ($errors->any())
          <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-md">
            <h3 class="font-bold mb-2">Veuillez corriger les erreurs suivantes :</h3>
            <ul class="list-disc pl-5">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        
        <form action="{{ route('visiteurs.update', $visiteur->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Colonne de gauche -->
            <div>
              <div class="mb-5">
                <label for="visiteur_nom" class="block text-sm font-medium text-sky-700 mb-1">Nom du visiteur *</label>
                <input type="text" name="visiteur_nom" id="visiteur_nom" 
                       value="{{ old('visiteur_nom', $visiteur->visiteur_nom) }}"
                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus"
                       required>
              </div>
              
              <div class="mb-5">
                <label for="visiteur_prenom" class="block text-sm font-medium text-sky-700 mb-1">Prénom du visiteur *</label>
                <input type="text" name="visiteur_prenom" id="visiteur_prenom" 
                       value="{{ old('visiteur_prenom', $visiteur->visiteur_prenom) }}"
                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus"
                       required>
              </div>
              
              <div class="mb-5">
                <label for="visiteur_telephone" class="block text-sm font-medium text-sky-700 mb-1">Téléphone *</label>
                <input type="tel" name="visiteur_telephone" id="visiteur_telephone" 
                       value="{{ old('visiteur_telephone', $visiteur->visiteur_telephone) }}"
                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus"
                       required>
              </div>
              
              <div class="mb-5">
                <label for="photo" class="block text-sm font-medium text-sky-700 mb-1">Photo du visiteur</label>
                <div class="flex items-center">
                  @if($visiteur->photo)
                    <img src="{{ asset('storage/' . $visiteur->photo) }}" alt="Photo actuelle" class="w-16 h-16 rounded-full object-cover border-2 border-sky-300 mr-4">
                  @else
                    <div class="w-16 h-16 rounded-full bg-sky-100 flex items-center justify-center text-sky-500 font-bold text-xl border-2 border-sky-300 mr-4">
                      {{ strtoupper(substr($visiteur->visiteur_nom, 0, 1)) }}
                    </div>
                  @endif
                  <input type="file" name="photo" id="photo" class="w-full">
                </div>
              </div>
              
              <div class="mb-5">
                <label class="block text-sm font-medium text-sky-700 mb-1">Statut *</label>
                <div class="grid grid-cols-2 gap-3">
                  <div>
                    <input type="radio" name="statut" id="en_attente" value="en attente" 
                           class="hidden peer" {{ old('statut', $visiteur->statut) == 'en attente' ? 'checked' : '' }}>
                    <label for="en_attente" class="block text-center py-2 px-4 rounded-lg border border-gray-300 peer-checked:border-amber-500 peer-checked:bg-amber-50 cursor-pointer">
                      <i class="fas fa-clock text-amber-500 mr-1"></i> En attente
                    </label>
                  </div>
                  <div>
                    <input type="radio" name="statut" id="valide" value="validé" 
                           class="hidden peer" {{ old('statut', $visiteur->statut) == 'validé' ? 'checked' : '' }}>
                    <label for="valide" class="block text-center py-2 px-4 rounded-lg border border-gray-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 cursor-pointer">
                      <i class="fas fa-check-circle text-emerald-500 mr-1"></i> Validé
                    </label>
                  </div>
                  <div>
                    <input type="radio" name="statut" id="refuse" value="refusé" 
                           class="hidden peer" {{ old('statut', $visiteur->statut) == 'refusé' ? 'checked' : '' }}>
                    <label for="refuse" class="block text-center py-2 px-4 rounded-lg border border-gray-300 peer-checked:border-rose-500 peer-checked:bg-rose-50 cursor-pointer">
                      <i class="fas fa-times-circle text-rose-500 mr-1"></i> Refusé
                    </label>
                  </div>
                  <div>
                    <input type="radio" name="statut" id="bannie" value="bannie" 
                           class="hidden peer" {{ old('statut', $visiteur->statut) == 'bannie' ? 'checked' : '' }}>
                    <label for="bannie" class="block text-center py-2 px-4 rounded-lg border border-gray-300 peer-checked:border-red-700 peer-checked:bg-red-50 cursor-pointer">
                      <i class="fas fa-ban text-red-700 mr-1"></i> Banni
                    </label>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Colonne de droite -->
            <div>
              <div class="mb-5">
                <label for="visiteur_piece_identite" class="block text-sm font-medium text-sky-700 mb-1">Type de pièce d'identité *</label>
                <select name="visiteur_piece_identite" id="visiteur_piece_identite" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus">
                  <option value="Carte d'identité" {{ old('visiteur_piece_identite', $visiteur->visiteur_piece_identite) == "Carte d'identité" ? 'selected' : '' }}>Carte d'identité</option>
                  <option value="Passeport" {{ old('visiteur_piece_identite', $visiteur->visiteur_piece_identite) == "Passeport" ? 'selected' : '' }}>Passeport</option>
                  <option value="Permis de conduire" {{ old('visiteur_piece_identite', $visiteur->visiteur_piece_identite) == "Permis de conduire" ? 'selected' : '' }}>Permis de conduire</option>
                  <option value="Carte consulaire" {{ old('visiteur_piece_identite', $visiteur->visiteur_piece_identite) == "Carte consulaire" ? 'selected' : '' }}>Carte consulaire</option>
                </select>
              </div>
              
              <div class="mb-5">
                <label for="visiteur_numero_piece" class="block text-sm font-medium text-sky-700 mb-1">Numéro de pièce *</label>
                <input type="text" name="visiteur_numero_piece" id="visiteur_numero_piece" 
                       value="{{ old('visiteur_numero_piece', $visiteur->visiteur_numero_piece) }}"
                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus"
                       required>
              </div>
              
              <div class="mb-5">
                <label for="motif_visite" class="block text-sm font-medium text-sky-700 mb-1">Motif de la visite *</label>
                <textarea name="motif_visite" id="motif_visite" rows="2"
                          class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus"
                          required>{{ old('motif_visite', $visiteur->motif_visite) }}</textarea>
              </div>
              
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
                <div>
                  <label for="heure_entree" class="block text-sm font-medium text-sky-700 mb-1">Heure d'entrée</label>
                  <input type="datetime-local" name="heure_entree" id="heure_entree" 
                         value="{{ old('heure_entree', $visiteur->heure_entree ? date('Y-m-d\TH:i', strtotime($visiteur->heure_entree)) : '') }}"
                         class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus">
                </div>
                
                <div>
                  <label for="heure_sortie" class="block text-sm font-medium text-sky-700 mb-1">Heure de sortie</label>
                  <input type="datetime-local" name="heure_sortie" id="heure_sortie" 
                         value="{{ old('heure_sortie', $visiteur->heure_sortie ? date('Y-m-d\TH:i', strtotime($visiteur->heure_sortie)) : '') }}"
                         class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus">
                </div>
              </div>
              
              <div class="mb-5">
                <label for="locataire_id" class="block text-sm font-medium text-sky-700 mb-1">Locataire visité *</label>
                <select name="locataire_id" id="locataire_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus" required>
                  @foreach($locataires as $locataire)
                    <option value="{{ $locataire->id }}" {{ $locataire->id == old('locataire_id', $visiteur->id) ? 'selected' : '' }}>
                      {{ $locataire->nom }} {{ $locataire->prenom }} - {{ $locataire->appartement }}
                    </option>
                  @endforeach
                </select>
              </div>
              
              <div class="mb-5">
                <label for="observations" class="block text-sm font-medium text-sky-700 mb-1">Observations</label>
                <textarea name="observations" id="observations" rows="3"
                          class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none input-focus">{{ old('observations', $visiteur->observations) }}</textarea>
              </div>
            </div>
          </div>
          
          <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.visit') }}" class="px-6 py-3 rounded-lg font-medium btn-secondary text-white">
              <i class="fas fa-times mr-2"></i> Annuler
            </a>
            <button type="submit" class="px-6 py-3 rounded-lg font-medium btn-primary text-white">
              <i class="fas fa-save mr-2"></i> Mettre à jour
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>
  
  <!-- Pied de page -->
  <footer class="py-6 bg-white bg-opacity-80 text-center text-sky-700 mt-8">
    <div class="container mx-auto px-4">
      <p class="mb-2">Système de gestion des visiteurs Neo Start</p>
      <p class="text-sm">© {{ date('Y') }} Tous droits réservés</p>
    </div>
  </footer>
</body>
</html>