<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'image_url'];

    public function cocktails()
    {
        return $this->belongsToMany(Cocktail::class);
    }
}