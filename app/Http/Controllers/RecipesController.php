<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe; 

class RecipesController extends Controller
{
    //getでrecipes/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $recipes = Recipe::paginate(20);
    
        return view('welcome', [
            'recipes' => $recipes,    
        ]);
    }
    //getでresipes/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $recipe = new Recipe;
        
        return view('recipes.create',[
           'recipe' => $recipe, 
        ]);
    }
    
    // postでrecipes/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'name' => 'required|max:191',
        //     'content' => 'required|max:191',
        //     'ingredients.*.quantity' => 'required|max:191',
        //     'quantity' => 'required|max:191',
        //     'how_to_make' => 'required|max:191',
        // ]);
        
        $recipe = $request->user()->recipes()->create([
            'name' => $request->name,
            'content' => $request->content,
        ]);
        
        $ingredients = collect();
        
        foreach ($request ->ingredients as $ingredientAttrs) {
          if (empty($ingredientAttrs['ingredient']) || empty($ingredientAttrs['quantity'])) {
              continue;
          }
          
          $ingredient = $recipe->ingredient()->create($ingredientAttrs);
         
          $ingredients->push($ingredient);
          
        }
        
        $how_to = collect();
        
        foreach($request->how_to as $howToMakeAttrs){
            if(empty($howToMakeAttrs['how_to_make'])){
                continue;
            }
            $how_to_make = $recipe->how_to()->create($howToMakeAttrs);
            
            $how_to->push($how_to_make);
           
        }
         
        return back();
    }
    
    // getでrecipes/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $recipe = Recipe::find($id);
        $ingredient = Recipe::find($id)->ingredient;
        $how_to = Recipe::find($id)->how_to;
       
        return view('recipes.show',[
            'recipe' => $recipe,
            'ingredients' => $ingredient,
            'how_tos' => $how_to,
        ]);
    }
    
    // getでrecipes/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        
        return view('recipes.edit',[
            'recipe' => $recipe
        ]);
    }
    
    // putまたはpatchでrecipes/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        $recipe->name = $recipe->name;
        $recipe->content = $recipe->content;
        $recipe->ingredient = $recipe->ingredient;
        $recipe->quantity = $recipe->quantity;
        $recipe->how_to_make = $recipe->how_to_make;
        $recipe->save();
        
        return back();
    }
    
    // deleteでrecipes/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
        
        return back();
    }
}
