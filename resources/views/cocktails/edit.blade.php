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
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $cocktail->name }}" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="image_url" class="block text-gray-700">Image URL</label>
                <input type="text" name="image_url" id="image_url" value="{{ $cocktail->image_url }}" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Categories</label>
                @foreach ($categories as $category)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="categories[]" value="{{ $category['strCategory'] }}" class="mr-2">
                        <span class="bg-gray-800 text-white rounded-full px-2 py-1">{{ $category['strCategory'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Glasses</label>
                @foreach ($glasses as $glass)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="glasses[]" value="{{ $glass['strGlass'] }}" class="mr-2">
                        <span class="bg-gray-800 text-white rounded-full px-2 py-1">{{ $glass['strGlass'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Ingredients</label>
                @foreach ($ingredients as $ingredient)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="ingredients[]" value="{{ $ingredient['strIngredient1'] }}" class="mr-2">
                        <span class="bg-gray-800 text-white rounded-full px-2 py-1">{{ $ingredient['strIngredient1'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Alcoholic</label>
                @foreach ($alcoholic as $alcohol)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="alcoholic[]" value="{{ $alcohol['strAlcoholic'] }}" class="mr-2">
                        <span class="bg-gray-800 text-white rounded-full px-2 py-1">{{ $alcohol['strAlcoholic'] }}</span>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">Update</button>
        </form>
    </div>
</body>
</html>