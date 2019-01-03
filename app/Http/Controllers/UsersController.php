<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Recipe;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        $recipes = $user->recipes()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' =>$user,
            'recipes' =>$recipes,
        ];
        
        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
    
    public function favorites($id)
    {
        $user = User::find($id);
        $favorites = $user->favorites()->paginate(10);
        
        $data = [
                'user' => $user,
                'favorites' => $favorites,
            ];
        
        $data += $this->counts($user);
        
        return view('users.favorites', $data);
    }
}
