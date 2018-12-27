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
    
    public function how_to()
    {
        return $this->hasMany(HowTo::class);
    }
}
