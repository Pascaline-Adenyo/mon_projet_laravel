


<div class="p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Détail de la visite</h2>

    <p><strong>Nom visiteur :</strong> {{ $visite->visiteur_nom }} {{ $visite->visiteur_prenom }}</p>
    <p><strong>Téléphone :</strong> {{ $visite->visiteur_telephone }}</p>
    <p><strong>Motif :</strong> {{ $visite->motif_visite }}</p>
    <p><strong>Heure entrée :</strong> {{ $visite->heure_entree }}</p>

    <form action="{{ route('visite.confirmer', $visite->id) }}" method="POST" class="inline-block">
        @csrf
        @method('PUT')
        <button class="bg-green-500 text-white px-4 py-2 rounded mt-4">Confirmer</button>
    </form>

    <form action="{{ route('visite.refuser', $visite->id) }}" method="POST" class="inline-block ml-4">
        @csrf
        @method('PUT')
        <button class="bg-red-500 text-white px-4 py-2 rounded mt-4">Refuser</button>
    </form>
</div>

