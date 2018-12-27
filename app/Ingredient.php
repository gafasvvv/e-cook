<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['recipe_id', 'ingredient', 'quantity'];
    
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
