<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class SyncCocktailCategories extends Command
{
    protected $signature = 'sync:cocktail-categories';
    protected $description = 'Sync cocktail categories from API to database';

    public function handle()
    {
        $response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/list.php?c=list');
        $categories = $response->json()['drinks'] ?? [];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['strCategory']]
            );
        }

        $this->info('Cocktail categories synchronized successfully.');
    }
};