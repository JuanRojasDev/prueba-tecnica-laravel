<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alcoholic extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function cocktails()
    {
        return $this->belongsToMany(Cocktail::class);
    }
}