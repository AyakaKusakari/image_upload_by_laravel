@extends('layout')

@section('content')
    <h1 class="text-center mt-2 mb-5">画像アップロード - 完了</h1>
    <div class="text-center">
        <p>画像を登録しました！</p>
        <a href="{{ route('index') }}">トップページへ戻る</a></div>
    </div>
@endsection