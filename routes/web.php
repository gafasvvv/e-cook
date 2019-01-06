<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//トップページの表示
Route::get('/', 'RecipesController@index');

//ユーザー登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//ユーザー機能
Route::group(['middleware' => 'auth'], function(){
    Route::resource('users', 'UsersController', ['only' => 'show']);
    
    //レシピ関係
    Route::resource('recipes', 'RecipesController');
    
    //お気に入り関係(ユーザー)
    Route::group(['prefix' => 'users/{id}'], function(){
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
    });
    //お気に入り関係（レシピ）
    Route::group(['prefix' => 'recipes/{id}'], function(){
       Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
       Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
    
});

//プロフィール画像投稿機能
Route::group(['middleware'=>'auth'], function(){
    Route::post('/upload', 'ProfileController@upload');
});

// //料理画像投稿機能
// Route::group(['middleware'=>'auth'], function(){
//     Route::post('/uploadcontent', 'UploadContentController@upload');
// });

//検索機能
Route::get('/paginate', 'SearchController@index')->name('search.index');
