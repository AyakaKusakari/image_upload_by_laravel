@extends('layout')

@section('content')
    <h1 class="text-center mt-2 mb-5">画像アップロード</h1>
    <div class="container mb-5">
        {{ Form::open(['route' => 'confirm', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            @csrf
            <div class="form-group row">
                <p class="col-sm-4 col-form-label">お名前</p>
                <div class="col-sm-8">
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
            </div>
            @if ($errors->first('name'))
                <p class="alert alert-danger">{{ $errors->first('name') }}</p>
            @endif

            <div class="form-group row">
                <p class="col-sm-4 col-form-label">画像</p>
                <div class="col-sm-8">
                    {{ Form::file('image') }}
                </div>
            </div>
            @if ($errors->first('image'))
                <p class="alert alert-danger">{{ $errors->first('image') }}</p>
            @endif

            <div class="text-center">
                {{ Form::submit('確認画面へ', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" style="width: 30%">お名前</th>
                <th scope="col">画像</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($uploadedImages as $uploadedImage)
                    <tr>
                        <td>{{ $uploadedImage->name }}</td>
                        <td><img src="{{ asset('img/' . $uploadedImage->id . "/" . $uploadedImage->image) }}"></td>
                    </tr>
                @endforeach
        </table>
    </div>

    {{ $uploadedImages->links() }}
@endsection