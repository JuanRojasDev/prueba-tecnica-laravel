<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Cocktail;
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
                $cocktails = array_filter($cocktails, function($cocktail) use ($searchTerm) {
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
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'category' => 'required',
                'image_url' => 'required|url',
            ]);

            Cocktail::create($request->only(['name', 'category', 'image_url']));
            session()->flash('swal_message', '¡Cóctel agregado exitosamente!');
            session()->flash('swal_type', 'success'); // Esto se puede cambiar a 'error' si es necesario
            return redirect()->route('cocktails.index')->with('success', 'Cocktail added successfully!');
        }

        $selectedCategory = $request->input('category', '');
        $searchTerm = $request->input('search', '');

        $cocktailsQuery = Cocktail::query();

        if ($selectedCategory) {
            $cocktailsQuery->where('category', $selectedCategory);
        }

        if ($searchTerm) {
            $cocktailsQuery->where('name', 'like', '%' . $searchTerm . '%');
        }

        $cocktails = $cocktailsQuery->get();
        $categories = Category::all();
        $categoriesString = '';
        foreach ($categories as $category) {
            $checked = $selectedCategory == $category->name ? 'checked' : '';
            $categoriesString .= '<label class="flex items-center mr-4 mb-2">';
            $categoriesString .= '<input type="radio" name="category" value="' . $category->name . '" class="mr-2" ' . $checked . '>';
            $categoriesString .= '<span class="bg-gray-800 text-white rounded-full px-2 py-1">' . $category->name . '</span>';
            $categoriesString .= '</label>';
        }

        return view('cocktails.store', compact('cocktails', 'categoriesString', 'selectedCategory'));
    }

    public function destroy(Cocktail $cocktail)
    {
        $cocktail->delete();

        return redirect()->route('cocktails.index')->with('success', '¡Cóctel eliminado!');
    }
    
    public function show(Cocktail $cocktail)
    {
        return view('cocktails.show', compact('cocktail'));
    }
}