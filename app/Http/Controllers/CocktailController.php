<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Cocktail;
use App\Models\Alcoholic;
use App\Models\Glass;
use App\Models\Ingredient;
use App\Models\Category;

class CocktailController extends Controller
{
    public function fetchCocktails(Request $request)
    {
        try {
            // Fetch categories
            $categoryResponse = Http::get('https://www.thecocktaildb.com/api/json/v1/1/list.php?c=list');
            $categories = $categoryResponse->json()['drinks'] ?? [];

            // Fetch cocktails based on selected category and search term
            $selectedCategory = $request->input('category', '');
            $searchTerm = $request->input('search', '');

            if ($selectedCategory) {
                $response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/filter.php?c=' . urlencode($selectedCategory));
                $cocktails = $response->json()['drinks'] ?? [];
            } else {
                $cocktails = [];
                foreach ($categories as $category) {
                    $response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/filter.php?c=' . urlencode($category['strCategory']));
                    $cocktails = array_merge($cocktails, $response->json()['drinks'] ?? []);
                }
            }

            // Filter cocktails by search term
            if ($searchTerm) {
                $cocktails = array_filter($cocktails, function ($cocktail) use ($searchTerm) {
                    return stripos($cocktail['strDrink'], $searchTerm) !== false;
                });
            }

            // Add category to each cocktail
            foreach ($cocktails as &$cocktail) {
                if ($selectedCategory) {
                    $cocktail['strCategory'] = $selectedCategory;
                }
            }

            // Paginate the results
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 20;
            $currentItems = array_slice($cocktails, ($currentPage - 1) * $perPage, $perPage);
            $cocktails = new LengthAwarePaginator($currentItems, count($cocktails), $perPage, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $request->query(),
            ]);

            // Build categories string
            $categoriesString = '';
            foreach ($categories as $category) {
                $checked = $selectedCategory == $category['strCategory'] ? 'checked' : '';
                $categoriesString .= '<label class="flex items-center mr-4 mb-2">';
                $categoriesString .= '<input type="radio" name="category" value="' . $category['strCategory'] . '" class="mr-2" ' . $checked . '>';
                $categoriesString .= '<span class="bg-gray-800 text-white rounded-full px-2 py-1">' . $category['strCategory'] . '</span>';
                $categoriesString .= '</label>';
            }
        } catch (\Exception $e) {
            Log::error('Error fetching data: ' . $e->getMessage());
            $categories = $cocktails = [];
            $categoriesString = '';
        }

        return view('cocktails.index', compact('cocktails', 'categoriesString', 'selectedCategory'));
    }

    public function store(Request $request)
    {
        if ($request->isMethod('get')) {
            $cocktails = Cocktail::all();
            return view('cocktails.store', compact('cocktails'));
        }

        $request->validate([
            'name' => 'required',
            'image_url' => 'required|url',
            'categories' => 'array',
            'glasses' => 'array',
            'ingredients' => 'array',
            'alcoholic' => 'array',
        ]);

        $cocktail = Cocktail::create($request->only(['name', 'image_url']));

        if ($request->has('categories')) {
            $cocktail->categories()->sync($request->input('categories'));
        }
        if ($request->has('glasses')) {
            $cocktail->glasses()->sync($request->input('glasses'));
        }
        if ($request->has('ingredients')) {
            $cocktail->ingredients()->sync($request->input('ingredients'));
        }
        if ($request->has('alcoholic')) {
            $cocktail->alcoholic()->sync($request->input('alcoholic'));
        }

        return redirect()->route('cocktails.index')->with('success', 'Cóctel guardado exitosamente.');
    }
    
    public function destroy(Cocktail $cocktail)
    {
        $cocktail->categories()->detach();
        $cocktail->glasses()->detach();
        $cocktail->ingredients()->detach();
        $cocktail->alcoholic()->detach();

        $cocktail->delete();

        return redirect()->route('cocktails.index')->with('success', '¡Cóctel eliminado!');
    }

    public function show(Cocktail $cocktail)
    {
        return view('cocktails.show', compact('cocktail'));
    }

    public function edit(Cocktail $cocktail)
    {
        $categories = Category::all();
        $glasses = Glass::all();
        $ingredients = Ingredient::all();
        $alcoholic = Alcoholic::all();

        return view('cocktails.edit', compact('cocktail', 'categories', 'glasses', 'ingredients', 'alcoholic'));
    }

    public function update(Request $request, Cocktail $cocktail)
    {
        $request->validate([
            'name' => 'required',
            'image_url' => 'required|url',
            'categories' => 'array',
            'glasses' => 'array',
            'ingredients' => 'array',
            'alcoholic' => 'array',
        ]);

        $cocktail->update($request->only(['name', 'image_url']));

        $cocktail->categories()->sync($request->input('categories', []));
        $cocktail->glasses()->sync($request->input('glasses', []));
        $cocktail->ingredients()->sync($request->input('ingredients', []));
        $cocktail->alcoholic()->sync($request->input('alcoholic', []));

        return redirect()->route('cocktails.index')->with('success', 'Cocktail updated successfully!');
    }
}
