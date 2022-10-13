@extends('app')

@section('title', 'Laralove | Post Show')

@section('content')

@include('nav')

<div class="container">
    <div class="card mt-3">
        <div class="text-center mt-1">
            <img src="https://placehold.jp/500x500.png" class="w-50" alt="...">
        </div>
        <div class="card-body">
            <h4 class="card-title my-3 ml-5 pl-2">投稿タイトル</h4>
            <div class="card-text">
                <div class="d-flex">
                    <a href="{{ route('user.show' , '1') }}"><img src="https://placehold.jp/500x500.png" class="rounded-circle circle-sm mr-2" alt=""></a>
                    <span>テキストテキストテキストテキストテキストテキストテキストテキストテキスト</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection