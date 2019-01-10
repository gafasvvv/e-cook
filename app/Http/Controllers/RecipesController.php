<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Recipe;
use App\User;

class RecipesController extends Controller
{
    //getでrecipes/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $recipes = Recipe::paginate(8);
        $user = new User;
        
        $rankings = DB::table('user_recipe')
                    ->join('recipes', 'user_recipe.recipe_id', '=', 'recipes.id')
                    ->select(['user_recipe.recipe_id', 'recipes.name', 'recipes.content', 'recipes.photo_url', DB::raw('count(*) as count')])
                    ->groupBy('user_recipe.recipe_id', 'recipes.name', 'recipes.content', 'recipes.photo_url')
                    ->orderBy('count','user_recipe.recipe_id', 'recipes.name', 'recipes.content', 'recipes.photo_url', 'DESC')
                    ->take(3)
                    ->get();
        
        return view('welcome', [
            'recipes' => $recipes,
            'user' => $user,
            'rankings' => $rankings,
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
        
        $this->validate($request,[
             'name' => 'required|max:191',
             'content' => 'required|max:191',
        //      'ingredient' => 'required|max:191',
        //      'quantity' => 'required|max:191',
        //      'how_to_make' => 'required|max:191',
        ]);
        
        $recipe = $request->user()->recipes()->create([
            'name' => $request->name,
            'content' => $request->content,
        ]);
        
        $ingredients = collect();
        foreach ($request ->ingredients as $ingredientAttrs) {
          if (empty($ingredientAttrs['ingredient']) || empty($ingredientAttrs['quantity'])) {
              continue;
          }
          
          $ingredient = $recipe->ingredients()->create($ingredientAttrs);
         
          $ingredients->push($ingredient);
          
        }
        
        $how_tos = collect();
        
        foreach($request->how_tos as $howToMakeAttrs){
            if(empty($howToMakeAttrs['how_to_make'])){
                continue;
            }
            $how_to_make = $recipe->how_tos()->create($howToMakeAttrs);
            
            $how_tos->push($how_to_make);
           
        }
        
        return redirect()->route('recipes.show', ['id' => $recipe]);

                        
    }
    
    // getでrecipes/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $recipe = Recipe::find($id);
        $ingredients = Recipe::find($id)->ingredients;
        $how_tos = Recipe::find($id)->how_tos;
        
        return view('recipes.show',[
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'how_tos' => $how_tos,
        ]);
    }
    
    // getでrecipes/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $ingredients = Recipe::find($id)->ingredients;
        $how_tos = Recipe::find($id)->how_tos;
        return view('recipes.edit',[
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'how_tos' => $how_tos,
        ]);
    }
    
    // putまたはpatchでrecipes/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        
        //料理名とひとことを更新
        $recipe->name = $request->name;
        $recipe->content = $request->content;
        $recipe->save();
        
        //元々の材料と分量を削除
        $recipe->ingredients;
        foreach($recipe->ingredients as $ingredient) {
            $ingredient->delete();
        }
        
        //コレクションインスタンスを生成
        $ingredients = collect();
        //$request->ingredientsのingredientとquantityが空でも続ける
        foreach($request->ingredients as $ingredientAttrs){
            if (empty($ingredientAttrs['ingredient']) || empty($ingredientAttrs['quantity'])) {
                continue;
            }
            //新しいモデルを保存してインスタンスを返します。
            $ingredient = $recipe->ingredients()->create($ingredientAttrs);
            //$ingredientsの最後にアイテム$ingredientを追加
            $ingredients->push($ingredient);
          
        }
        
        //元々の作り方を削除
        $recipe->how_tos;
        foreach($recipe->how_tos as $how_to) {
            $how_to->delete();
        }
        
        //コレクションインスタンスを生成
        $how_tos = collect();
        //$request->how_tosのhow_to_makeが空でも続ける
        foreach($request->how_tos as $howToMakeAttrs){
            if(empty($howToMakeAttrs['how_to_make'])){
                continue;
            }
            //新しいモデルを保存してインスタンスを返します。
            $how_to_make = $recipe->how_tos()->create($howToMakeAttrs);
            //$how_tosの最後にアイテム$how_to_makeを追加
            $how_tos->push($how_to_make);
           
        }
        
        return redirect('/');
    }
    
    // deleteでrecipes/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        if(\Auth::id() === $recipe->user_id){
            $recipe->delete();
        }
        
        return back();
    }
    
}
