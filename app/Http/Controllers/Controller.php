<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user){
        $count_recipes = $user->recipes()->count();
        $count_favorites = $user->favorites()->count();
        
        return [
            'count_recipes' => $count_recipes,
            'count_favorites' => $count_favorites,
        ];
    }
}
