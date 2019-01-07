<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Recipe;
use App\User;

class UploadContentController extends Controller
{
    /**
     * 料理画像ファイルのアップロード処理
     */
    public function upload(Request $request ,$id)
    {
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
        
        $recipe= Recipe::find($id);
        $recipe->photo_url = $url;
        $recipe->save();

        return redirect()
                ->back()
                ->with('s3url', $url);
    }
}