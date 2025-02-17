<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image_url'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function glasses()
    {
        return $this->belongsToMany(Glass::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function alcoholic()
    {
        return $this->belongsToMany(Alcoholic::class);
    }
};
