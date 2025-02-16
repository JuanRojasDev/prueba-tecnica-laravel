<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CocktailController extends Controller
{
    public function fetchCocktails()
    {
        try {
            $response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/filter.php?c=Cocktail');
            $cocktails = $response->json()['drinks'] ?? [];
        } catch (\Exception $e) {
            Log::error('Error fetching cocktails: ' . $e->getMessage());
            $cocktails = [];
        }

        return view('cocktails.index', compact('cocktails'));
    }
}