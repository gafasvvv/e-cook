<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HowTo extends Model
{
    protected $fillable = ['recipe_id', 'how_to_make'];
    
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
