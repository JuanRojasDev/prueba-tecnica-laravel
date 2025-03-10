<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CocktailController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/cocktails', function () {
    return view('cocktails');
})->middleware(['auth', 'verified'])->name('cocktails.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cocktails', [CocktailController::class, 'fetchCocktails'])->name('cocktails.index');
    Route::match(['get', 'post'], '/my-cocktails', [CocktailController::class, 'store'])->name('cocktails.store');    
    Route::get('/cocktails/{cocktail}', [CocktailController::class, 'show'])->name('cocktails.show');    
    Route::put('/cocktails/{cocktail}', [CocktailController::class, 'update'])->name('cocktails.update');
    Route::delete('/cocktails/{cocktail}', [CocktailController::class, 'destroy'])->name('cocktails.destroy');
    Route::get('/cocktails/{cocktail}/edit', [CocktailController::class, 'edit'])->name('cocktails.edit');
});

require __DIR__.'/auth.php';
