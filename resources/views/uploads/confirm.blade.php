@extends('layout')

@section('content')
    <h1 class="text-center mt-2 mb-5">画像アップロード - 確認画面</h1>
    <div class="container mb-5">
        {{ Form::open(['route' => 'complete', 'method' => 'POST']) }}
            @csrf
            <div class="form-group row">
                <p class="col-sm-4 col-form-label">お名前</p>
                <div class="col-sm-8">
                    {{ $name }}
                </div>
                <input type="hidden" name="name" value="{{ $name }}">
            </div>
            
            <div class="form-group row">
                <p class="col-sm-4 col-form-label">画像</p>
                <div class="col-sm-8">
                    <img src="{{ $image }}" alt="">
                </div>
                <input type="hidden" name="image" value="{{ $newImageName }}">
            </div>

            <div class="text-center">
                {{ Form::submit('登録', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div>
@endsection