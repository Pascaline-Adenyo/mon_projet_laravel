<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de la visite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-50 text-gray-800">
    <div class="bg-white p-6 rounded shadow-md max-w-xl mx-auto">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">Détail de la Visite</h1>

        <p><strong>Nom :</strong> {{ $visite->visiteur_nom }}</p>
        <p><strong>Prénom :</strong> {{ $visite->visiteur_prenom }}</p>
        <p><strong>Téléphone :</strong> {{ $visite->visiteur_telephone }}</p>
        <p><strong>Motif :</strong> {{ $visite->motif_visite }}</p>
        <p><strong>Date :</strong> {{ $visite->heure_entree }}</p>

        <div class="mt-6 flex space-x-4">
            <form method="POST" action="{{ route('visite.confirmer', $visite->id) }}"
                onsubmit="return confirm('Es-tu sûr(e) de vouloir confirmer cette visite ?')">
                @csrf
                @method('PUT')
                <button class="bg-green-600 text-white px-4 py-2 rounded">Confirmer</button>
            </form>

            <form method="POST" action="{{ route('visite.refuser', $visite->id) }}"
                 onsubmit="return confirm('Es-tu sûr(e) de vouloir refuser cette visite ?')">
                @csrf
                @method('PUT')
                <button class="bg-yellow-500 text-white px-4 py-2 rounded">Refuser</button>
            </form>

            <form method="POST" action="{{ route('visite.bannir', $visite->id) }}"
                 onsubmit="return confirm('Es-tu sûr(e) de vouloir bannir ce visiteur ?')">
                @csrf
                @method('PUT')
                <button class="bg-red-600 text-white px-4 py-2 rounded">Bannir</button>
            </form>
        </div>
    </div>
</body>
</html>
