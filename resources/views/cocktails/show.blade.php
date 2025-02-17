<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Cocktail</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 font-sans text-gray-900">
    <!-- Mostrar alerta si hay un mensaje -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md shadow-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-4xl font-bold text-center mb-2">{{ $cocktail->name }}</h1>
    <div class="container mx-auto px-4 py-12">
        <img class="modal-image" src="{{ $cocktail->image_url }}" alt="{{ $cocktail->name }}">
        <p class="text-white mt-4">Category: {{ $cocktail->category ?? 'Unknown Category' }}</p>
        <a href="{{ route('cocktails.edit', $cocktail->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">Edit</a>

        <!-- Formulario de eliminación -->
        <form id="delete-form" method="POST" action="{{ route('cocktails.destroy', $cocktail->id) }}" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">Delete</button>
        </form>
    </div>
</body>
</html>