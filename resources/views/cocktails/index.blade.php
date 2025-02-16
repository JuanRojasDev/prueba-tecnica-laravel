<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktails</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-center mb-10">🍹 Explore Cocktails</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($cocktails as $cocktail)
                <div class="cocktail-card bg-white rounded-lg shadow-sm overflow-hidden transition-transform transform hover:scale-105">
                    <img class="w-full h-48 object-cover" src="{{ $cocktail['strDrinkThumb'] }}" alt="{{ $cocktail['strDrink'] }}">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $cocktail['strDrink'] }}</h2>
                        <p class="text-gray-600 mt-1">Refreshing & Delicious 🍸</p>

                        <form method="POST" action="{{ route('cocktails.store') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="name" value="{{ $cocktail['strDrink'] }}">
                            <input type="hidden" name="image_url" value="{{ $cocktail['strDrinkThumb'] }}">
                            <button type="submit" class="save-btn w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors">
                                💾 Save Cocktail
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>