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
    
    /* Styles pour la recherche de locataire */
    .locataire-search-container {
      position: relative;
    }
    
    .locataire-search-input {
      position: relative;
      z-index: 2;
      background-color: rgba(255, 255, 255, 0.9) !important;
    }
    
    .locataire-search-input i {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #0ea5e9;
    }
    
    .locataire-list-container {
      position: relative;
      margin-top: 5px;
      max-height: 200px;
      overflow-y: auto;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      display: none;
      z-index: 10;
      background: white;
    }
    
    .locataire-list-container.visible {
      display: block;
    }
    
    .locataire-item {
      padding: 12px 15px;
      cursor: pointer;
      transition: all 0.2s;
      border-bottom: 1px solid #e5e7eb;
    }
    
    .locataire-item:last-child {
      border-bottom: none;
    }
    
    .locataire-item:hover {
      background-color: #f0f9ff;
    }
    
    .locataire-item.selected {
      background-color: #e0f2fe;
      font-weight: 500;
    }
    
    .no-results {
      padding: 12px 15px;
      color: #9ca3af;
      font-style: italic;
    }
  </style>
</head>
<body class="min-h-screen">

  <!-- En-tête -->
  <header class="bg-white/90 px-6 py-4 flex items-center justify-between shadow-md backdrop-blur-md sticky top-0 z-10 border-b border-sky-100">
    <div class="flex items-center space-x-4">
      <div class="bg-white p-2 rounded-xl shadow-md">
        <img src="https://www.neostart.tech/_nuxt/logo.DFn82Mk0.png" alt="Logo Neo Start" class="h-10 transition-transform duration-300 hover:scale-105">
      </div>
      <div>
        <h1 class="text-xl font-bold text-sky-800">Système de gestion des visiteurs</h1>
        <p class="text-sm text-sky-600">Formulaire de Visite</p>
      </div>
    </div>
    <nav class="flex flex-wrap items-center gap-4 text-sm md:text-base">
      <a href="{{ url('/home') }}" class="flex items-center text-sky-700 hover:text-sky-900 transition group">
        <span class="mr-1 group-hover:underline">Accueil</span>
        <i class="fas fa-home text-sky-600"></i>
      </a>
     
    </nav>
  </header>

  <!-- Contenu principal -->
  <div class="flex items-center justify-center py-10 px-4">
    <div class="bg-white bg-opacity-90 p-8 rounded-2xl w-full max-w-4xl text-gray-800 form-container form-card">
      <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-sky-800 section-title">ENREGISTREMENT VISITEUR</h2>
        <p class="mt-2 text-sky-600">Veuillez remplir tous les champs du formulaire</p>
      </div>

      <form class="space-y-6" action="{{ route('visiteurs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Ligne 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Nom</label>
            <input type="text" placeholder="Nom du visiteur" name="visiteur_nom" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Prénom</label>
            <input type="text" placeholder="Prénom du visiteur" name="visiteur_prenom" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
        </div>

        <!-- Ligne 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Téléphone</label>
            <input type="text" placeholder="Numéro de téléphone" name="visiteur_telephone" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Motif de la visite</label>
            <input type="text" placeholder="Raison de la visite" name="motif_visite" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
        </div>

        <!-- Ligne 3 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Type de pièce d'identité</label>
            <input type="text" placeholder="Carte d'identité, passeport..." name="visiteur_piece_identite" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Numéro de la pièce</label>
            <input type="text" placeholder="Numéro du document" name="visiteur_numero_piece" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
        </div>

        <!-- Ligne 4 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Heure d'entrée</label>
            <input type="time" name="heure_entree" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Heure de sortie</label>
            <input type="time" name="heure_sortie" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
        </div>

        <!-- Ligne 5 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Statut</label>
            <select name="statut" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
              <option value="">Sélectionnez un statut</option>
              <option value="en attente">En attente</option>
              <option value="validé">Validé</option>
              <option value="en cours">En cours</option>
              <option value="refusé">Refusé</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Observations</label>
            <input type="text" placeholder="Notes supplémentaires" name="observations" class="p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none">
          </div>
        </div>

        <!-- Ligne 6 - Recherche de locataire améliorée -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-medium text-sky-700 mb-1">Locataire</label>
            <div class="locataire-search-container">
              <div class="relative">
                <input 
                  type="text" 
                  id="locataire-search" 
                  placeholder="Rechercher un locataire..." 
                  class="locataire-search-input p-3 rounded-xl w-full border border-gray-300 input-focus focus:outline-none pl-10"
                >
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              </div>
              
              <div id="locataire-list" class="locataire-list-container">
                <!-- La liste des locataires sera injectée ici par JavaScript -->
              </div>
              
              <input type="hidden" name="locataire_id" id="selected-locataire-id">
            </div>
          </div>
        </div>

        <!-- Photo -->
        <div class="grid grid-cols-1 gap-5">
          <div>
            <label class="block text-sm font-medium text-sky-700 mb-1">Photo du visiteur</label>
            <input type="file" name="photo" accept="image/*" class="p-3 rounded-xl w-full border border-gray-300 bg-white/70 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-100 file:text-sky-700 hover:file:bg-sky-200">
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
  <footer class="py-6 bg-white/80 text-center text-sky-700 border-t border-sky-100">
    <div class="container mx-auto px-4">
      <p class="mb-1 flex justify-center items-center gap-2">
        <i class="fas fa-building text-sky-600"></i>
        Système de gestion des visiteurs <strong class="ml-1">Neo Start</strong>
      </p>
      <p class="text-xs text-sky-500">© 2023 Tous droits réservés</p>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('locataire-search');
      const locataireList = document.getElementById('locataire-list');
      const selectedLocataireId = document.getElementById('selected-locataire-id');

      // Récupérer les locataires depuis votre base de données
      // Ceci est un exemple de structure, remplacez par vos données réelles
      const locataires = [
        @foreach($locataires as $locataire)
          { 
            id: {{ $locataire->id }}, 
            nom: "{{ $locataire->nom }}", 
            prenom: "{{ $locataire->prenom }}",
            appartement: "{{ $locataire->appartement ?? 'N/A' }}"
          },
        @endforeach
      ];

      // Fonction pour afficher les locataires dans la liste
      function displayLocataires(locatairesArray) {
        if (locatairesArray.length === 0) {
          locataireList.innerHTML = '<div class="no-results">Aucun locataire trouvé</div>';
          locataireList.classList.add('visible');
          return;
        }

        locataireList.innerHTML = '';
        locatairesArray.forEach(locataire => {
          const item = document.createElement('div');
          item.className = 'locataire-item';
          item.dataset.id = locataire.id;
          item.innerHTML = `
            <div class="font-medium">${locataire.nom} ${locataire.prenom}</div>
            <div class="text-xs text-gray-500">Appartement ${locataire.appartement}</div>
          `;
          
          item.addEventListener('click', () => {
            // Mettre à jour le champ de recherche avec le nom du locataire
            searchInput.value = `${locataire.nom} ${locataire.prenom}`;
            // Stocker l'ID dans le champ caché
            selectedLocataireId.value = locataire.id;
            // Fermer la liste
            locataireList.classList.remove('visible');
            
            // Ajouter une bordure verte pour indiquer la sélection
            searchInput.style.borderColor = '#10b981';
            setTimeout(() => {
              searchInput.style.borderColor = '';
            }, 2000);
          });
          
          locataireList.appendChild(item);
        });
        
        locataireList.classList.add('visible');
      }

      // Filtrer les locataires en fonction de la recherche
      searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        if (searchTerm === '') {
          locataireList.classList.remove('visible');
          selectedLocataireId.value = '';
          return;
        }
        
        const filteredLocataires = locataires.filter(locataire => {
          const fullName = `${locataire.nom} ${locataire.prenom}`.toLowerCase();
          return fullName.includes(searchTerm);
        });
        
        displayLocataires(filteredLocataires);
      });

      // Fermer la liste quand on clique en dehors
      document.addEventListener('click', function(event) {
        if (!event.target.closest('.locataire-search-container')) {
          locataireList.classList.remove('visible');
        }
      });

      // Ouvrir la liste quand on clique sur le champ
      searchInput.addEventListener('click', function() {
        if (this.value === '') {
          displayLocataires(locataires);
        }
      });

      // Navigation au clavier dans la liste
      searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
          e.preventDefault();
          const items = locataireList.querySelectorAll('.locataire-item');
          
          if (items.length === 0) return;
          
          let currentSelected = locataireList.querySelector('.locataire-item.selected');
          let index = -1;
          
          if (currentSelected) {
            index = Array.from(items).indexOf(currentSelected);
            currentSelected.classList.remove('selected');
          }
          
          if (e.key === 'ArrowDown') {
            index = (index + 1) % items.length;
          } else if (e.key === 'ArrowUp') {
            index = (index - 1 + items.length) % items.length;
          }
          
          items[index].classList.add('selected');
          items[index].scrollIntoView({ block: 'nearest' });
        } else if (e.key === 'Enter') {
          const selectedItem = locataireList.querySelector('.locataire-item.selected');
          if (selectedItem) {
            selectedItem.click();
            e.preventDefault();
          }
        }
      });
    });
  </script>
</body>
</html>