<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktail Haven</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/coctel.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans antialiased dark">
    <div class="container mx-auto px-4 py-6">
        <!-- Navbar -->
        <nav class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <img src="{{ asset('images/coctel.png') }}" alt="Cocktail Haven Logo" class="h-10 w-10 mr-2">
                <span class="text-2xl font-bold">Cocktail Haven</span>
            </div>
            <div>
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Inciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-300 hover:text-white">Registrate</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex flex-col md:flex-row items-center justify-between mt-16">
            <div class="md:w-2/2">
            <h1 class="text-7xl font-black leading-tight stroke-white">Cocktail</h1>
            <h1 class="text-7xl font-black leading-tight mb-6 stroke-white">Haven</h1>
            <p class="text-gray-400 text-xl mb-10">Descubre los mejores cócteles de todo el mundo. Refrescante, deliciosa y perfecta para cualquier ocasión.</p>
            <a href="{{ url('/cocktails') }}" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-lg shadow-lg hover:bg-blue-700 transition-transform transform hover:scale-105">Ver Cocteles</a>
            </div>
            <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
            <img src="{{ asset('images/coctel.png') }}" alt="Cocktail Image" class="h-auto w-3/4 drop-shadow-[0px_10px_10px_rgba(0,0,0,0.5)]">
            </div>
        </div>
    </div>
    <footer class="flex justify-end mt-16 px-12 sm:items-center">
        <div class="text-right text-sm text-gray-500 dark:text-gray-400 sm:mr-6 md:mr-12 lg:mr-18 xl:mr-18">
            Laravel Prueba Técnica PsicoAlianza - Juan Rojas 2025
        </div>
    </footer>
</body>
</html>