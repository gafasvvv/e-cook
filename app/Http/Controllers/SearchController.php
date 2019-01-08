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
        
        //もしキーワードが入力されていれば
        if(!empty($keyword))
        {
            $recipes = DB::table('recipes')
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->paginate(4);
            
            $recipes = Recipe::whereHas('ingredients', function ($query) use ($keyword){
                $query->where('ingredient', 'like','%'.$keyword.'%');
            })->paginate(4);
            
        }else{
            $recipes = DB::table('recipes')->paginate(4);
        }
        
        // dd($query);
        return view('search.index',[
            'recipes' => $recipes,
            'keyword' => $keyword,
            ]);
    }
}
