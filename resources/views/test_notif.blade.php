<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Notifications Locataire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-50 text-gray-800">
    @php
        $locataire = \App\Models\Locataire::first();
    @endphp

    <h1 class="text-2xl font-bold text-blue-700 mb-4">Notifications de {{ $locataire->nom }}</h1>

    @foreach($locataire->unreadNotifications as $notification)
        <div class="bg-white shadow p-4 rounded mb-3">
            <p class="mb-2">{{ $notification->data['message'] }}</p>
            <a href="{{ $notification->data['url'] }}" class="text-blue-600 underline">Voir la visite</a>
        </div>
    @endforeach
</body>
</html>
