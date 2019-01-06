<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Recipe;
use App\User;

class RecipesController extends Controller
{
    //getでrecipes/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $recipes = Recipe::paginate(16);
        $user = new User;
    
        return view('welcome', [
            'recipes' => $recipes,
            'user' => $user,
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
        //      'name' => 'required|max:191',
        //      'content' => 'required|max:191',
        //      'ingredient' => 'required|max:191',
        //      'quantity' => 'required|max:191',
        //      'how_to_make' => 'required|max:191',
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
        
        $this->validate($request, [
            'myfile' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MINRタイプを指定
                'mimes:jpeg,png',
                // 最小縦横120px, 最大縦横1350px
                'dimensions:min_width=120,min_height=120,max_width=1350,max_height=1350',
            ]
        ]);

        $image = $request->file('myfile');
        /**
         * 自動生成されたファイル名が付与されてS3に保存される。
         * 第三引数に'public'を付与しないと外部からアクセスできないので注意。
         */
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        /* ファイルパスから参照するURLを生成する */
        $url = Storage::disk('s3')->url($path);
        
        $recipe = new Recipe;
        
        $recipe->user_id = auth()->id();
        
        $recipe->photo_url = $url;
        
        $recipe->save();

        return redirect()
                ->back()
                ->with('s3url', $url);
        
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
        
        return redirect('/');
    }
    
}
