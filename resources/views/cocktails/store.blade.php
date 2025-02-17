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
        <h1 class="text-4xl font-bold text-center">🍹 Mis Cocteles Guardados</h1>
    </x-slot>
    <div class="container mx-auto px-4 py-12">
        <div id="cocktails-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($cocktails as $cocktail)
                <div class="cocktail-card bg-gray-800 rounded-lg shadow-sm overflow-hidden transition-transform transform hover:scale-105 relative cursor-pointer" onclick="openModal({{ $cocktail->id }})">
                    <img class="w-full h-48 object-cover" src="{{ $cocktail->image_url }}" alt="{{ $cocktail->name }}">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $cocktail->name }}</h2>
                        <p class="text-gray-600 mt-1">Frescura y Sabor Inigualable 🍸</p>
                    </div>
                    <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-bl-lg">
                        {{ $cocktail->category ?? 'Unknown Category' }}
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 col-span-4">
                    No cocktails found in this category.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal -->
    <div id="cocktail-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-gray-800 text-white rounded-lg overflow-hidden w-3/4 h-3/4 modal-content">
            <div class="p-4">
                <button onclick="closeModal()" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">X</button>
            </div>
            <div id="modal-content" class="p-4">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        function openModal(cocktailId) {
            fetch(`/cocktails/${cocktailId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modal-content').innerHTML = html;
                    document.getElementById('cocktail-modal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('cocktail-modal').classList.add('hidden');
            document.getElementById('modal-content').innerHTML = '';
        }
    </script>
</x-app-layout>
</body>
</html>