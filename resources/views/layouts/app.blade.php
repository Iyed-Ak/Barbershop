<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Salon de Coiffure')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('home') }}" class="text-2xl font-bold">
                    <i class="fas fa-cut mr-2"></i>Salon Coiffure
                </a>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-blue-400">Accueil</a>
                    
                    @auth
                        <a href="{{ route('reservation.create') }}" class="hover:text-blue-400">Réserver</a>
                        <a href="{{ route('reservations.my') }}" class="hover:text-blue-400">Mes Réservations</a>
                        
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">
                                <i class="fas fa-cog mr-2"></i>Admin
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-red-400">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-blue-400">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Salon de Coiffure. Tous droits réservés.</p>
            <p class="text-sm text-gray-400 mt-2">Fermé le lundi</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>