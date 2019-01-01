<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Recipe::class, 'user_recipe', 'user_id', 'recipe_id')
                    ->withTimestamps();
    }
    
    public function favorite($recipeId)
    {
        //すでにお気に入りしているか確認
        $exist = $this->is_favorite($recipeId);
        //相手が自分自身ではないか確認
        $its_me = $this->id == $recipeId;
        
        if($exist || $its_me){
            //すでにお気に入りしていなければ何もしない
            return false;
        } else {
            //まだお気に入りしてなければお気に入りする
            $this->favorites()->attach($recipeId);
            return true;
        }
    }
    
     public function unfavorite($recipeId)
    {
        //すでにお気に入りしているか確認
        $exist = $this->is_favorite($recipeId);
        //相手が自分自身ではないか確認
        $its_me = $this->id == $recipeId;
        
        if($exist && !$its_me){
            //すでにお気に入りしていればお気に入りを外す
            $this->favorites()->detach($recipeId);
            return true;
        } else {
            //まだお気に入りしてなければ何もしない
            return false;
        }
    }
    
    public function is_favorite($recipeId)
    {
        return $this->favorites()->where('recipe_id', $recipeId)->exists();
    }
}
