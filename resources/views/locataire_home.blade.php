<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Locataire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('translate-x-0');
            });

            // Charts initialization
            if (document.getElementById('visitsChart')) {
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
            }

            if (document.getElementById('reasonsChart')) {
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
            }
        });
    </script>
    <style>
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.5rem;
        }
        
        .status-badge {
            padding: 0.35rem 0.9rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.025em;
        }
        
        .table-row-hover:hover {
            background-color: #f0f9ff;
        }
        
        .sidebar-item {
            transition: all 0.3s ease;
        }
        
        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid #38bdf8;
        }
    </style>
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
            <nav class="space-y-1">
                
                
                <a href="{{ route('locataires.index') }}" class="flex items-center p-3 rounded-lg sidebar-item">
                    <i class="fas fa-users mr-3 text-sky-400"></i>
                    <span>Liste des locataires</span>
                </a>
                <a href="#" class="flex items-center p-3 rounded-lg sidebar-item bg-sky-700">
                    <i class="fas fa-tachometer-alt mr-3 text-white"></i>
                    <span class="text-white">Tableau de bord</span>
                </a>
            </nav>
            
            <div class="mt-10 pt-6 border-t border-sky-700">
                <div class="flex items-center p-3">
                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-10 h-10"></div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Locataire</p>
                        <p class="text-xs text-sky-300">{{ Auth::user()->email ?? 'email@example.com' }}</p>
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
                        <h1 class="text-2xl font-bold text-sky-800">Tableau de Bord Locataire</h1>
                    </div>
                    <div class="flex items-center">
                        <div class="relative mr-4">
                            <button class="p-1 rounded-full text-sky-700 hover:text-sky-900 focus:outline-none">
                                <i class="fas fa-bell text-xl"></i>
                            </button>
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">2</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8 mr-2"></div>
                            <span class="text-sky-800 font-medium">{{ Auth::user()->nom ?? 'Locataire' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Content Container -->
        <div class="container mx-auto p-4 sm:p-6">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-sky-800 mb-2">Bienvenue {{ Auth::user()->nom ?? 'Locataire' }}</h1>
                <p class="text-sky-600">Votre tableau de bord personnel</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500 card-hover">
                    <div class="flex items-center">
                        <div class="stat-icon bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Visites aujourd'hui</p>
                            <h2 class="text-2xl font-bold text-blue-600">{{ $visitesAujourdHui }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500 card-hover">
                    <div class="flex items-center">
                        <div class="stat-icon bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-calendar-week"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Visites cette semaine</p>
                            <h2 class="text-2xl font-bold text-green-600">{{ $visitesSemaine }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-orange-500 card-hover">
                    <div class="flex items-center">
                        <div class="stat-icon bg-orange-100 text-orange-600 mr-4">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Visites en cours</p>
                            <h2 class="text-2xl font-bold text-orange-600">{{ $visitesEnCours }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-purple-500 card-hover">
                    <div class="flex items-center">
                        <div class="stat-icon bg-purple-100 text-purple-600 mr-4">
                            <i class="fas fa-history"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total visites</p>
                            <h2 class="text-2xl font-bold text-purple-600">{{ $nombreTotal }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-amber-500 card-hover">
                    <div class="flex items-center">
                        <div class="stat-icon bg-amber-100 text-amber-600 mr-4">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Visites en cours</p>
                            <h2 class="text-2xl font-bold text-amber-600">{{ $visitesEnCours }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-gray-500 card-hover">
                    <div class="flex items-center">
                        <div class="stat-icon bg-gray-100 text-gray-600 mr-4">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Visites terminées</p>
                            <h2 class="text-2xl font-bold text-gray-600">{{ $visitesTerminees }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Vos visites par jour (7 derniers jours)</h2>
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

            <!-- Recent Visits Table -->
            <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-blue-800">Historique de vos visites</h2>
                    <button class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                        <i class="fas fa-download mr-2"></i> Exporter
                    </button>
                </div>
                
                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Visiteur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Heure d'arrivée</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($mesVisites as $visite)
                            <tr class="table-row-hover">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-10 h-10 mr-3"></div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $visite->nom_visiteur }}</p>
                                            <p class="text-sm text-gray-500">Motif: {{ $visite->motif }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock text-gray-400 mr-2"></i>
                                        {{ $visite->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($visite->statut == 'En cours') bg-green-100 text-green-800
                                        @elseif($visite->statut == 'Terminé') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $visite->statut }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="text-blue-600 hover:text-blue-800 mr-3">
                                        <i class="fas fa-eye"></i> Détails
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination corrigée -->
                <div class="mt-6 flex justify-between items-center">
                    <span class="text-sm text-gray-700">
                        Total: {{ count($mesVisites) }} visites
                    </span>
                    <div class="text-sm text-gray-500">
                        Affichage des {{ count($mesVisites) }} dernières visites
                    </div>
                </div>
            </div>

            <footer class="text-center text-sm text-blue-700 py-6">
                &copy; 2025 - Système de gestion des visiteurs - Neo Start
            </footer>
        </div>
    </div>
</body>
</html>