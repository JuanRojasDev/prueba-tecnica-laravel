<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Cocktail</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-center mb-10">{{ $cocktail->name }}</h1>
        <img class="w-full h-48 object-cover" src="{{ $cocktail->image_url }}" alt="{{ $cocktail->name }}">
        <p class="text-gray-600 mt-4">Category: {{ $cocktail->category }}</p>
        <a href="{{ route('cocktails.edit', $cocktail->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">Edit</a>
        <form method="POST" action="{{ route('cocktails.destroy', $cocktail->id) }}" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">Delete</button>
        </form>
    </div>
</body>
</html>