<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Uploader;

class UploadersController extends Controller
{
    public function index()
    {
        $uploadedImages = Uploader::orderBy('created_at', 'desc')->paginate(5);

        return view('uploads.index', [
            'uploadedImages' => $uploadedImages,
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'image' => 'required|image',
        ]);

        // お名前を取得
        $name = $request->name;

        // 拡張子つきでファイル名を取得
        $imageName = $request->file('image')->getClientOriginalName();

        // 拡張子のみ
        $extension = $request->file('image')->getClientOriginalExtension();

        // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
        $newImageName = pathinfo($imageName, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;

        $request->file('image')->move(public_path() . "/img/tmp", $newImageName);
        $image = "/img/tmp/" . $newImageName;

        return view('uploads.confirm', [
            'name'         => $name,
            'image'        => $image,
            'newImageName' => $newImageName,
        ]);
    }

    public function complete(Request $request)
    {
        $uploader = new Uploader();
        $uploader->name  = $request->name;
        $uploader->image = $request->image;
        $uploader->save();

        // レコードを挿入したときのIDを取得
        $lastInsertedId = $uploader->id;

        // ディレクトリを作成
        if (!file_exists(public_path() . "/img/" . $lastInsertedId)) {
            mkdir(public_path() . "/img/" . $lastInsertedId, 0777);
        }

        // 一時保存から本番の格納場所へ移動
        rename(public_path() . "/img/tmp/" . $request->image, public_path() . "/img/" . $lastInsertedId . "/" . $request->image);
        
        // 一時保存の画像を削除
        \File::cleanDirectory(public_path() . "/img/tmp");

        return view('uploads.complete');
    }
}
