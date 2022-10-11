@extends('app')

@section('title', 'User Show')

@section('content')

@include('nav')

<div class="container">
    <div class="d-flex justify-content-center mt-2">
        <img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-md mt-3">
        <div>
            <h3 class="mt-4 ml-4">User Name</h3>
            <h5 class="mt-2 ml-4">@screen_id</h5>
            <button class="ml-4 btn btn-primary px-5">フォロー</button>
        </div>
    </div>
    <hr>
    <ul class="nav nav-tabs nav-pills d-flex justify-content-around">
        <li class="nav-item">
            <a href="#photo" class="nav-link active" data-toggle="tab">写真</a>
        </li>
        <li class="nav-item">
            <a href="#like" class="nav-link" data-toggle="tab">いいね</a>
        </li>
    </ul>
    <hr>
    <div class="tab-content">
        <div id="photo" class="tab-pane active">
            <div class="d-flex row">
                <div class="col-4">
                    <a href="{{ route('post.show', ['id' => '1']) }}"><img src="https://placehold.jp/500x500.png" class="w-100" alt="..."></a>
                </div>
                <div class="col-4">
                    <a href="{{ route('post.show', ['id' => '1']) }}"><img src="https://placehold.jp/500x500.png" class="w-100" alt="..."></a>
                </div>
                <div class="col-4">
                    <a href="{{ route('post.show', ['id' => '1']) }}"><img src="https://placehold.jp/500x500.png" class="w-100" alt="..."></a>
                </div>
            </div>
        </div>
        <div id="like" class="tab-pane">
            <div class="d-flex row">
                <div class="col-4">
                    <a href="{{ route('post.show', ['id' => '1']) }}"><img src="https://placehold.jp/500x500.png" class="w-100" alt="..."></a>
                </div>
                <div class="col-4">
                    <a href="{{ route('post.show', ['id' => '1']) }}"><img src="https://placehold.jp/500x500.png" class="w-100" alt="..."></a>
                </div>
                <div class="col-4">
                    <a href="{{ route('post.show', ['id' => '1']) }}"><img src="https://placehold.jp/500x500.png" class="w-100" alt="..."></a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
