<?php

namespace App\Http\Controllers;

use Request;
use App\Recipe;

class SearchController extends Controller
{
    public function getIndex()
    {
        //検索するテキスト取得
        $search = Request::get('s');
        $query = Recipe::query();
        
        //検索するテキストが入力されている場合のみ
         if(!empty($search)){
             $query->where('name', 'like', '%'.$search.'%');
         }
         
         $data = Recipe::get();
         return view('search.index', compact('data'));
    }
}
