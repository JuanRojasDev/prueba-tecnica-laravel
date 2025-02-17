<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cocktail</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-100 font-sans">
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-center mb-10 text-white">Edit Cocktail</h1>
        <div class="bg-gray-800 rounded-lg shadow-md p-6 flex space-x-6">
            <img class="w-1/3 rounded-lg object-cover" src="{{ $cocktail->image_url }}" alt="{{ $cocktail->name }}">
            <form method="POST" action="{{ route('cocktails.update', $cocktail->id) }}" class="w-2/3">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-300 mb-2">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $cocktail->name) }}" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100">
                </div>

                <!-- URL de Imagen -->
                <div class="mb-4">
                    <label for="image_url" class="block text-gray-300 mb-2">Image URL</label>
                    <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $cocktail->image_url) }}" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100">
                </div>

                <!-- Categorías -->
                <div class="mb-4">
                    <label for="categories" class="block text-gray-300 mb-2">Categories</label>
                    <select name="categories[]" id="categories" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100">
                        @foreach ($categories as $category)
                            <option value="{{ $category['strCategory'] }}"
                                    {{ in_array($category['strCategory'], $cocktail->categories->pluck('name')->toArray()) ? 'selected' : '' }}>
                                {{ $category['strCategory'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Vasos -->
                <div class="mb-4">
                    <label for="glasses" class="block text-gray-300 mb-2">Glasses</label>
                    <select name="glasses[]" id="glasses" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100">
                        @foreach ($glasses as $glass)
                            <option value="{{ $glass['strGlass'] }}"
                                    {{ in_array($glass['strGlass'], $cocktail->glasses->pluck('name')->toArray()) ? 'selected' : '' }}>
                                {{ $glass['strGlass'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Ingredientes -->
                <div class="mb-4">
                    <label for="ingredients" class="block text-gray-300 mb-2">Ingredients</label>
                    <select name="ingredients[]" id="ingredients" class="w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-gray-100">
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient['strIngredient1'] }}"
                                    {{ in_array($ingredient['strIngredient1'], $cocktail->ingredients->pluck('name')->toArray()) ? 'selected' : '' }}>
                                {{ $ingredient['strIngredient1'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- ¿Es alcohólico? -->
                <div class="mb-4">
                    <label class="block text-gray-300 mb-2">Alcoholic</label>
                    @foreach ($alcoholic as $alcohol)
                        <div class="flex items-center mb-2">
                            <input type="radio" name="alcoholic" value="{{ $alcohol['strAlcoholic'] }}"
                                   {{ $cocktail->alcoholic->contains('name', $alcohol['strAlcoholic']) ? 'checked' : '' }}
                                   class="text-blue-500">
                            <span class="ml-2 text-gray-300">{{ $alcohol['strAlcoholic'] }}</span>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                    Update
                </button>
            </form>
        </div>
    </div>
</body>
</html>
