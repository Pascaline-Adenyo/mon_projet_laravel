<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Gestion des Visiteurs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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

        .card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center items-center px-4">

    <header class="text-center mb-10">
        <img src="https://www.neostart.tech/_nuxt/logo.DFn82Mk0.png" class="h-20 mx-auto mb-4" alt="Neo Start Logo">
        <h1 class="text-3xl font-bold text-sky-800">Bienvenue sur le système de gestion des visiteurs</h1>
        <p class="text-sky-600 mt-2">Gérez facilement les visiteurs et les locataires de votre immeuble.</p>
    </header>

    <main class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-5xl">
        <a href="{{ route('visiteurs.create') }}" class="card p-6 flex flex-col items-center text-center text-sky-700 font-medium hover:text-sky-900">
            <i class="fas fa-plus fa-2x mb-3 text-sky-500"></i>
            <span>Enregistrer un visiteur</span>
        </a>

        <a href="{{ route('locataires.create') }}" class="card p-6 flex flex-col items-center text-center text-sky-700 font-medium hover:text-sky-900">
            <i class="fas fa-user-plus fa-2x mb-3 text-sky-500"></i>
            <span>Ajouter un locataire</span>
        </a>

        <a href="{{ route('visiteurs.index') }}" class="card p-6 flex flex-col items-center text-center text-sky-700 font-medium hover:text-sky-900">
            <i class="fas fa-list fa-2x mb-3 text-sky-500"></i>
            <span>Liste des visiteurs</span>
        </a>

        <a href="{{ route('locataires.index') }}" class="card p-6 flex flex-col items-center text-center text-sky-700 font-medium hover:text-sky-900">
            <i class="fas fa-users fa-2x mb-3 text-sky-500"></i>
            <span>Liste des locataires</span>
        </a>

        <a href="{{ url('/historique') }}" class="card p-6 flex flex-col items-center text-center text-sky-700 font-medium hover:text-sky-900">
            <i class="fas fa-clock fa-2x mb-3 text-sky-500"></i>
            <span>Historique des visites</span>
        </a>
    </main>

    <footer class="mt-12 text-center text-sm text-sky-700">
        <p>&copy; 2025 - Système de gestion des visiteurs - Neo Start</p>
    </footer>

</body>
</html>
