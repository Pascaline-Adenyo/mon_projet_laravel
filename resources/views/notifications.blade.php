<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Notifications du Locataire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100 text-gray-800">
    {{-- On suppose que $locataire est passé depuis le contrôleur --}}
<h1 class="text-2xl font-bold text-blue-700 mb-4">Notifications de {{ $locataire->nom }}</h1>

    @foreach($locataire->unreadNotifications as $notification)
        <div class="bg-white shadow p-4 rounded mb-4">
            <p class="mb-2 text-gray-700 font-medium">{{ $notification->data['message'] }}</p>
            <a href="{{ $notification->data['url'] }}" class="text-blue-600 underline">Voir la visite</a>
        </div>
    @endforeach
</body>
</html>
