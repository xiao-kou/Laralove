@extends('app')

@section('title', 'User Show')

@section('content')

@include('nav')

<div class="container">
    <div class="d-flex justify-content-center align-items-center mt-3">
        <img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-md">
        <div>
            <h4 class="mt-1 ml-4">User Name</h4>
            <h5 class="mt-1 ml-4">@screen_id</h5>
            <button class="ml-4 mt-1 btn btn-primary btn-sm">フォロー</button>
            <button class="ml-2 mt-1 btn btn-secondary btn-sm">フォロワー一覧</button>
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
            <div class="d-flex row align-items-center">
                @foreach($user->posts as $post)
                    <div class="col-4">
                        <a href="{{ route('post.show', ['id' => $post->id]) }}"><img src="{{ asset($post->file_path) }}" class="w-100" alt="..."></a>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="like" class="tab-pane">
            <div class="d-flex row">
                @foreach($user->posts as $post)
                    <div class="col-4">
                        <a href="{{ route('post.show', ['id' => $post->id]) }}"><img src="{{ asset($post->file_path) }}" class="w-100" alt="..."></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection
