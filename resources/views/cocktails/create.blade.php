<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Cocktail</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-center mb-10">Create Cocktail</h1>
        <form method="POST" action="{{ route('cocktails.store') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="category" class="block text-gray-700">Category</label>
                <input type="text" name="category" id="category" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="image_url" class="block text-gray-700">Image URL</label>
                <input type="text" name="image_url" id="image_url" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">Save</button>
        </form>
    </div>
</body>
</html>