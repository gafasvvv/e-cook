<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Recipe;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        //キーワードを取得
        $name = $request->input('name');
        $ingredient = $request->input('ingredient');
        
        //もしキーワードが入力されている場合
        if(!empty($name))
        {   
            //料理名から検索
            $recipes = DB::table('recipes')
                    ->where('name', 'like', '%'.$name.'%')
                    ->paginate(4);
                    
        }elseif(!empty($ingredient)){ 
                    
            //材料名から検索
            $recipes = Recipe::whereHas('ingredients', function ($query) use ($ingredient){
                $query->where('ingredient', 'like','%'.$ingredient.'%');
            })->paginate(4);
            
        }else{
            //キーワードが入力されていない場合
            $recipes = DB::table('recipes')->paginate(4);
        }
        
        return view('search.index',[
            'recipes' => $recipes,
            'name' => $name,
            'ingredient' => $ingredient
            ]);
    }
}
