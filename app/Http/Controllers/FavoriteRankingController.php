<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Recipe;

class FavoriteRankingController extends Controller
{
    public function index()
    {   
        
        
        $rankings = DB::table('user_recipe')
                    ->join('recipes', 'user_recipe.recipe_id', '=', 'recipes.id')
                    ->select(['user_recipe.recipe_id', 'recipes.name', 'recipes.content', 'recipes.photo_url', DB::raw('count(*) as count')])
                    ->groupBy('user_recipe.recipe_id', 'recipes.name', 'recipes.content', 'recipes.photo_url')
                    ->orderBy('count','user_recipe.recipe_id', 'recipes.name', 'recipes.content', 'recipes.photo_url', 'DESC')
                    ->take(10)
                    ->paginate(9);
       
        return view('favorites.favorite_rankings',[
            'rankings' => $rankings,
            ]);
    }
}
