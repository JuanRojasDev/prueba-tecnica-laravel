<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktail Haven</title>
    <link rel="icon" href="{{ asset('images/coctel.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans antialiased">
<x-app-layout >
    <x-slot name="header">
        <h1 class="text-4xl font-bold text-center">🍹 Explora y Disfruta de los Mejores Cócteles</h1>
    </x-slot>
    <div class="container mx-auto px-4 py-12">
        <div class="p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
            <form id="filter-form" method="GET" action="{{ route('cocktails.index') }}" class="mb-8">
                <div class="flex flex-wrap justify-center mb-4">
                    <div class="relative w-full max-w-md">
                        <input type="text" name="search" id="search" placeholder="Buscar por nombre" class="w-full pl-10 pr-4 py-2 border border-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-gray-800 text-white" value="{{ request('search') }}">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center mb-4">
                    <label class="flex items-center mr-4 mb-2">
                        <input type="radio" name="category" value="" class="mr-2" {{ $selectedCategory == '' ? 'checked' : '' }}>
                        <span class="bg-gray-800 text-white rounded-full px-2 py-1">All</span>
                    </label>
                    {!! $categoriesString !!}
                </div>
            </form>
        </div>

        <div id="cocktails-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($cocktails as $cocktail)
                <div class="cocktail-card bg-gray-800 rounded-lg shadow-sm overflow-hidden transition-transform transform hover:scale-105 relative">
                    <img class="w-full h-48 object-cover" src="{{ $cocktail['strDrinkThumb'] }}" alt="{{ $cocktail['strDrink'] }}">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $cocktail['strDrink'] }}</h2>
                        <p class="text-gray-600 mt-1">Frescura y Sabor Inigualable 🍸</p>
                        <form method="POST" action="{{ route('cocktails.store') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="name" value="{{ $cocktail['strDrink'] }}">
                            <input type="hidden" name="category" value="{{ $cocktail['strCategory'] ?? 'Unknown Category' }}">
                            <input type="hidden" name="image_url" value="{{ $cocktail['strDrinkThumb'] }}">
                            <button type="submit" class="save-btn w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors">
                                💾 Guardar Cóctel
                            </button>
                        </form>
                    </div>
                    <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-bl-lg">
                        {{ $cocktail['strCategory'] ?? 'Unknown Category' }}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8 flex justify-center pagination-container">
            <div class="bg-gray-900 p-4 rounded-lg text-white">
                {{ $cocktails->links('layouts.pagination') }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const filterForm = document.getElementById('filter-form');
    const cocktailsContainer = document.getElementById('cocktails-container');
    const paginationContainer = document.querySelector('.pagination-container');

    function fetchCocktails() {
        const formData = new FormData(filterForm);
        const queryString = new URLSearchParams(formData).toString();
        const url = new URL(`{{ route('cocktails.index') }}`);
        url.search = queryString;

        // Remove duplicate page parameters
        const params = new URLSearchParams(url.search);
        if (params.has('page')) {
            const page = params.get('page');
            params.delete('page');
            params.append('page', page);
        }
        url.search = params.toString();

        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newCocktails = doc.getElementById('cocktails-container').innerHTML;
                const newPagination = doc.querySelector('.pagination-container').innerHTML;
                cocktailsContainer.innerHTML = newCocktails;
                paginationContainer.innerHTML = newPagination;
            })
            .catch(error => console.error('Error fetching cocktails:', error));
    }

    searchInput.addEventListener('input', fetchCocktails);
    filterForm.addEventListener('change', fetchCocktails);
});
</script>
</body>
</html>