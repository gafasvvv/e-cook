<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;

class ProfileController extends Controller
{
    //publicへ保存する際のコード
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    //  public function __construct()
    //  {
    //      $this->middleware('auth');
    //  }
     
    //  /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    //  public function index()
    //  {
    //      $user = User::find(auth()->id());
         
    //      return view('/', compact('user'));
    //  }
     
     /**
     * プロフィール画像のアップロード処理
     */
     public function upload(Request $request, $id)
     {
          $this->validate($request, [
              'file' => [
                  // 必須
                 'required',
                 // アップロードされたファイルであること
                 'file',
                 // 画像ファイルであること
                 'image',
                 // MIMEタイプを指定
                 'mimes:jpeg,png',
                 // 最小縦横120px 最大縦横400px
                 'dimensions:min_width=120,min_height=120,max_width=400,max_height=400',
                  ]
              ]);
            
             $image = $request->file('file');
             /**
              * 自動生成されたファイル名が付与されてS3に保存される。
              * 第三引数に'public'を付与しないと外部からアクセスできないので注意。
              */
            
             $path = Storage::disk('s3')->putFile('myprofile', $image, 'public');
             /* ファイルパスから参照するURLを生成する */
             $url = Storage::disk('s3')->url($path);
             
             $user= User::find($id);
             $user->avatar_url = $url;
             $user->save();
     
             return back()
                    ->with('s3url', $url);
                    
             //publicへ保存する際のコード
             // if ($request->file('file')->isValid([])){
             //     $filename = $request->file->store('public/avatar');
                 
             //     $user = User::find(auth()->id());
             //     $user->avatar_filename = basename($filename);
             //     $user->save();
                 
             //     return back()->with('success', '保存しました');
             // } else {
             //     return back()
             //            ->withInput()
             //            ->withErrors(['file' => '画像がアップロードされていません']);
             // }
    }
}
 
