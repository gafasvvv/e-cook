<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe; 

class RecipesController extends Controller
{
    //getでrecipes/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $data = [];
        if(\Auth::check()){
            $user = \Auth::user();
            $recipes = $user->recipes()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'recipes' => $recipes,
            ];
        }
        return view('welcome', $data);
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
          if (empty($ingredientAttr['ingredient']) || empty($ingredientAttr['quantity'])) {
              continue;
          }
          $ingredient = $recipe->ingredients()->create($ingredientAttrs);
          
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
        //
    }
    
    // getでrecipes/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        //
    }
    
    // putまたはpatchでrecipes/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        //
    }
    
    // deleteでrecipes/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $recipe = \App\Recipe::find($id);
        
        if(\Auth::id() === $recipe->user_id){
            $recipe->delete();
        }
        
        return back();
    }
}
