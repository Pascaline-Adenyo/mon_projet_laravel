<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Visiteurs</title>
  <script src="https://cdn.tailwindcss.com"></script> <!-- ✅ Lien indispensable -->
</head>

<div class="min-h-screen bg-sky-100 py-10">
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-sky-800 text-center">Liste des Visiteurs</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300 shadow-sm bg-white">
                <thead class="bg-sky-200 text-sky-800">
                    <tr>
                        <th class="border px-3 py-2">Nom</th>
                        <th class="border px-3 py-2">Prénom</th>
                        <th class="border px-3 py-2">Téléphone</th>
                        <th class="border px-3 py-2">Pièce</th>
                        <th class="border px-3 py-2">N° Pièce</th>
                        <th class="border px-3 py-2">Motif</th>
                        <th class="border px-3 py-2">Entrée</th>
                        <th class="border px-3 py-2">Sortie</th>
                        <th class="border px-3 py-2">Statut</th>
                        <th class="border px-3 py-2">Locataire</th>
                        <th class="border px-3 py-2">Gardien</th>
                        <th class="border px-3 py-2">Observations</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($visiteurs as $visiteur)
                    <tr class="hover:bg-sky-50 transition-colors">
                        <td class="border px-3 py-2">{{ $visiteur->visiteur_nom }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->visiteur_prenom }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->visiteur_telephone }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->visiteur_piece_identite }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->visiteur_numero_piece }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->motif_visite }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->heure_entree }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->heure_sortie }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->statut }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->locataire_id }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->gardien_id }}</td>
                        <td class="border px-3 py-2">{{ $visiteur->observations }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- @endsection --}}
