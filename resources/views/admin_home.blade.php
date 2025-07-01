<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Gestion des Visiteurs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Script pour gérer le menu responsive
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('translate-x-0');
            });
        });
    </script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 min-h-screen flex">
    <!-- Sidebar Navigation -->
    <div id="sidebar" class="w-64 bg-gradient-to-b from-sky-800 to-sky-900 text-white fixed h-full overflow-y-auto transition-transform duration-300 transform -translate-x-full lg:translate-x-0 z-20">
        <div class="p-5 border-b border-sky-700">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">Neo Start</h2>
                <button id="menu-toggle" class="lg:hidden text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <p class="text-sm text-sky-300 mt-1">Gestion des visiteurs</p>
        </div>
        
        <div class="py-6 px-4">
            <nav class="space-y-2">
                 <a href="{{ route('locataires.create') }}" class="flex items-center p-3 rounded-lg hover:bg-sky-700 transition-all group">
                    <i class="fas fa-user-plus mr-3 text-sky-400 group-hover:text-white"></i>
                    <span class="group-hover:text-white">Ajouter un locataire</span>
                </a>
               
                <a href="{{ url('/accueil') }}" class="flex items-center p-3 rounded-lg hover:bg-sky-700 transition-all group">
                    <i class="fas fa-home mr-3 text-sky-400 group-hover:text-white"></i>
                    <span class="group-hover:text-white">Ajouter visite</span>
                </a>
               
                <a href="{{ url('/admin/visites') }}" class="flex items-center p-3 rounded-lg hover:bg-sky-700 transition-all group">
                    <i class="fas fa-list mr-3 text-sky-400 group-hover:text-white"></i>
                    <span class="group-hover:text-white">Liste des visiteurs</span>
                </a>
                <a href="{{ route('locataires.index') }}" class="flex items-center p-3 rounded-lg hover:bg-sky-700 transition-all group">
                    <i class="fas fa-users mr-3 text-sky-400 group-hover:text-white"></i>
                    <span class="group-hover:text-white">Liste des locataires</span>
                </a>
            </nav>
            
            <div class="mt-10 pt-6 border-t border-sky-700">
                <div class="flex items-center p-3">
                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-10 h-10"></div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Administrateur</p>
                        <p class="text-xs text-sky-300">admin@neostart.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="flex-1 lg:ml-64">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <button id="menu-toggle" class="lg:hidden mr-3 text-sky-700">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-2xl font-bold text-sky-800">Tableau de Bord</h1>
                    </div>
                    <div class="flex items-center">
                        <div class="relative">
                            <button class="p-1 rounded-full text-sky-700 hover:text-sky-900 focus:outline-none">
                                <i class="fas fa-bell text-xl"></i>
                            </button>
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">3</span>
                        </div>
                        <div class="ml-4 flex items-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Content Container -->
        <div class="container mx-auto p-4 sm:p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500 transform transition-transform hover:scale-[1.02]">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-user-clock text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Visites aujourd'hui</p>
                            <h2 class="text-2xl font-bold text-blue-800">{{ $visitesAujourdHui }}</h2>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500 transform transition-transform hover:scale-[1.02]">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <i class="fas fa-calendar-week text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Visites cette semaine</p>
                            <h2 class="text-2xl font-bold text-green-800">{{ $visitesSemaine }}</h2>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-orange-500 transform transition-transform hover:scale-[1.02]">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-100 mr-4">
                            <i class="fas fa-door-open text-orange-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Visites en cours</p>
                            <h2 class="text-2xl font-bold text-orange-800">{{ $visitesEnCours }}</h2>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-purple-500 transform transition-transform hover:scale-[1.02]">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 mr-4">
                            <i class="fas fa-house-user text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Locataires</p>
                            <h2 class="text-2xl font-bold text-purple-800">{{ $locataires }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Visits Table -->
            <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-blue-800">Visites Récentes</h2>
                    <button class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                        <i class="fas fa-download mr-2"></i> Exporter
                    </button>
                </div>
                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Visiteur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Locataire</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Heure d'arrivée</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($visitesRecentes as $visite)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $visite->visiteur_nom }}</p>
                                        <p class="text-sm text-gray-500">{{ $visite->motif_visite }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $visite->locataire->nom ?? 'Inconnu' }} ({{ $visite->locataire->appartement ?? '-' }})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock text-gray-400 mr-2"></i>
                                        {{ $visite->heure_entree }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($visite->statut == 'En cours') bg-green-100 text-green-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ $visite->statut }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-800">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

          <!-- Stats Charts -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col">
        <h2 class="text-xl font-semibold text-blue-800 mb-4">Visites par jour (7 derniers jours)</h2>
        <div class="flex-1 min-h-[250px]">
            <canvas id="visitsChart"></canvas>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col">
        <h2 class="text-xl font-semibold text-blue-800 mb-4">Répartition des motifs de visite</h2>
        <div class="flex-1 min-h-[250px]">
            <canvas id="reasonsChart"></canvas>
        </div>
    </div>
</div>

            <footer class="text-center text-sm text-blue-700 py-6">
                &copy; 2025 - Système de gestion des visiteurs - Neo Start
            </footer>
        </div>
    </div>

    <script>
        // Charts initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Visits per day chart
            const visitsCtx = document.getElementById('visitsChart').getContext('2d');
            const visitsChart = new Chart(visitsCtx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [{
                        label: 'Nombre de visites',
                        data: [12, 19, 15, 22, 18, 25, 30],
                        backgroundColor: 'rgba(56, 189, 248, 0.2)',
                        borderColor: 'rgb(56, 189, 248)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgb(56, 189, 248)'
                    }]
                },
                options: {
                    responsive: true,
                    
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });

            // Visit reasons chart
            const reasonsCtx = document.getElementById('reasonsChart').getContext('2d');
            const reasonsChart = new Chart(reasonsCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Livraison', 'Visite', 'Maintenance', 'Autre'],
                    datasets: [{
                        data: [35, 25, 20, 20],
                        backgroundColor: [
                            'rgb(56, 189, 248)',
                            'rgb(16, 185, 129)',
                            'rgb(251, 146, 60)',
                            'rgb(139, 92, 246)'
                        ],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>