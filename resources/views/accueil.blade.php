<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulaire Visiteur</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-sky-100 to-sky-300 flex items-center justify-center">

  <div class="bg-white bg-opacity-90 p-8 rounded-xl shadow-2xl w-full max-w-4xl text-gray-800">
    <!-- Titre avec logo -->
    <div class="flex items-center justify-center mb-6 space-x-4">
      <img src="https://www.neostart.tech/_nuxt/logo.DFn82Mk0.png" alt="Logo Neo Start Technologie" class="h-12 w-12 rounded-full shadow-md">
      <h2 class="text-3xl font-bold">ENREGISTREMENT VISITEUR</h2>
    </div>

    <form class="space-y-4" action="{{ route('visiteurs.store') }}" method="POST">
        @csrf

        <!-- Ligne 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="text" placeholder="Nom" name="visiteur_nom" class="p-2 rounded w-full border border-gray-300">
          <input type="text" placeholder="Prénom" name="visiteur_prenom" class="p-2 rounded w-full border border-gray-300">
        </div>

        <!-- Ligne 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="text" placeholder="Téléphone" name="visiteur_telephone" class="p-2 rounded w-full border border-gray-300">
          <input type="text" placeholder="Motif de la visite" name="motif_visite" class="p-2 rounded w-full border border-gray-300">
        </div>

        <!-- Ligne 3 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="text" placeholder="Type de pièce d'identité" name="visiteur_piece_identite" class="p-2 rounded w-full border border-gray-300">
          <input type="text" placeholder="Numéro de la pièce" name="visiteur_numero_piece" class="p-2 rounded w-full border border-gray-300">
        </div>

        <!-- Ligne 4 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="time" name="heure_entree" class="p-2 rounded w-full border border-gray-300">
          <input type="time" name="heure_sortie" class="p-2 rounded w-full border border-gray-300">
        </div>

        <!-- Ligne 5 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <select name="statut" class="p-2 rounded w-full border border-gray-300">
            <option value="">Statut</option>
            <option value="en attente">En attente</option>
            <option value="validé">Validé</option>
            <option value="refusé">Refusé</option>
          </select>
          <input type="text" placeholder="Observations" name="observations" class="p-2 rounded w-full border border-gray-300">
        </div>

        <!-- Ligne 6 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="number" placeholder="ID Locataire" name="locataire_id" class="p-2 rounded w-full border border-gray-300">
          <input type="number" placeholder="ID Gardien" name="gardien_id" class="p-2 rounded w-full border border-gray-300">
        </div>

        <!-- Bouton -->
        <div class="text-center mt-6">
          <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-2 px-6 rounded-full">
            ENREGISTRER
          </button>
        </div>
    </form>
  </div>

</body>
</html>
