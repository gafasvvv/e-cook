<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['user_id', 'name', 'content', 'photo_url'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
    
    public function how_tos()
    {
        return $this->hasMany(HowTo::class);
    }
    
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'user_recipe', 'recipe_id', 'user_id')
                    ->withTimestamps();
    }
}
