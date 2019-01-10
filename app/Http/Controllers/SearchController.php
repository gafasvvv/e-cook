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
        $keyword = $request->input('keyword');
        
        //もしキーワードが入力されている場合
        if(!empty($keyword))
        {   
            //料理名から検索
            $recipes = DB::table('recipes')
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->paginate(4);
                    
            //材料名から検索
            $recipes = Recipe::whereHas('ingredients', function ($query) use ($keyword){
                $query->where('ingredient', 'like','%'.$keyword.'%');
            })->paginate(4);
            
        }else{
            //キーワードが入力されていない場合
            $recipes = DB::table('recipes')->paginate(4);
        }
        // dd($recipes);
        return view('search.index',[
            'recipes' => $recipes,
            'keyword' => $keyword,
            ]);
    }
}
