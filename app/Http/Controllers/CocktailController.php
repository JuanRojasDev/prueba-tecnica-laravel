<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Cocktail;

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

    public function store(Request $request)
    {
        $cocktail = new Cocktail();
        $cocktail->name = $request->input('name');
        $cocktail->category = $request->input('category', 'Cocktail');
        $cocktail->image_url = $request->input('image_url');
        $cocktail->save();
    
        return redirect()->route('cocktails.index')->with('success', 'Cocktail saved successfully!');
    }

    public function show(Cocktail $cocktail)
    {
        return view('cocktails.show', compact('cocktail'));
    }

    public function edit(Cocktail $cocktail)
    {
        return view('cocktails.edit', compact('cocktail'));
    }

    public function update(Request $request, Cocktail $cocktail)
    {
        $cocktail->name = $request->input('name');
        $cocktail->image_url = $request->input('image_url');
        $cocktail->save();

        return redirect()->route('cocktails.index')->with('success', 'Cocktail updated successfully!');
    }

    public function destroy(Cocktail $cocktail)
    {
        $cocktail->delete();

        return redirect()->route('cocktails.index')->with('success', 'Cocktail deleted successfully!');
    }
}