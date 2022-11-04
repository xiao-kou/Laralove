@extends('app')

@section('title', 'Laralove | Post Show')

@section('content')

@include('nav')

<div class="container">
    <div class="card mt-3">
        <div class="text-center mt-1">
            <img src="{{ asset($post->file_path) }}" class="w-50" alt="...">
        </div>
        <div class="card-body">
            <div class="card-text">
                <div class="post-show title-area">
                    <h3 class="text-center">{{ $post->title }}</h3>
                </div>
                <form id="destroy-button" method="POST" action="{{ route('posts.destroy', $post->id) }}" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
                <div class="d-flex align-items-center">
                    <a href="{{ route('user.show' , $post->user_id) }}"><img src="https://placehold.jp/500x500.png" class="rounded-circle circle-sm mr-2" alt=""></a>
                    <div>
                        <span>{{ $post->content }}</span>
                    </div>
                </div>
            </div>
        </div>
        @canany(['update', 'delete'], $post)
            <div class="text-right my-2 mr-3">
                    <button class="btn btn-primary mr-2" onclick="location.href='{{ route('posts.edit', $post->id) }}'">編集する</button>
                    <button form="destroy-button" class="btn btn-secondary" type="submit" onclick="return confirm('本当に削除しますか?')">削除する</button>
            </div>
        @endcan
    </div>
</div>

@endsection