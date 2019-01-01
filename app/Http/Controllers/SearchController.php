<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $recipe = new Recipe();
        
        if($request->has('name')){
            $recipe = $recipe
                    ->orWhere('name', 'LIKE', '%'.$request->input('name').'%');
        }
        
        // if($request->has('ingredient')){
        //     $recipe = $recipe
        //             ->join('ingredients','recipes.id', '=', 'ingredients.recipe_id')
        //             ->orWhere('ingredient', 'LIKE', '%'.$request->input('ingredient').'%');
        // }
        
        $pagedRecipes = $recipe->paginate(8)
                        ->appends($request->only(['name', 'ingredient']));
                        
        return view('search/index')
                ->with('name', $request->input('name'))
                ->with('ingredient', $request->input('ingredient'))
                ->with('recipes', $pagedRecipes);
    }
}
