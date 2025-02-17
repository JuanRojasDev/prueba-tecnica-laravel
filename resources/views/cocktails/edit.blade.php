<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cocktail</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-center mb-10">Edit Cocktail</h1>
        <form method="POST" action="{{ route('cocktails.update', $cocktail->id) }}">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $cocktail->name) }}" class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <!-- URL de Imagen -->
            <div class="mb-4">
                <label for="image_url" class="block text-gray-700">Image URL</label>
                <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $cocktail->image_url) }}" class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <!-- Categorías -->
            <div class="mb-4">
                <label class="block text-gray-700">Categories</label>
                @foreach ($categories as $category)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                               {{ $cocktail->categories->contains($category->id) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $category->name }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Vasos -->
            <div class="mb-4">
                <label class="block text-gray-700">Glasses</label>
                @foreach ($glasses as $glass)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="glasses[]" value="{{ $glass->id }}"
                               {{ $cocktail->glasses->contains($glass->id) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $glass->name }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Ingredientes -->
            <div class="mb-4">
                <label class="block text-gray-700">Ingredients</label>
                @foreach ($ingredients as $ingredient)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}"
                               {{ $cocktail->ingredients->contains($ingredient->id) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $ingredient->name }}</span>
                    </div>
                @endforeach
            </div>

            <!-- ¿Es alcohólico? -->
            <div class="mb-4">
                <label class="block text-gray-700">Alcoholic</label>
                @foreach ($alcoholic as $alcohol)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="alcoholic[]" value="{{ $alcohol->id }}"
                               {{ $cocktail->alcoholic->contains($alcohol->id) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $alcohol->name }}</span>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                Update
            </button>
        </form>
    </div>
</body>
</html>
