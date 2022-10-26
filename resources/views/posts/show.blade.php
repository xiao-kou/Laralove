@extends('app')

@section('title', 'Laralove | Post Show')

@section('content')

@include('nav')

<div class="container">
    <div class="card mt-3">
        <h3 class="card-title text-center mt-3">{{ $post->title }}</h3>
        <div class="text-center mt-1">
            <img src="{{ asset($post->file_path) }}" class="w-50" alt="...">
        </div>
        <div class="card-body">
            <div class="card-text">
                <div class="d-flex align-items-center">
                    <a href="{{ route('user.show' , $post->user_id) }}"><img src="https://placehold.jp/500x500.png" class="rounded-circle circle-sm mr-2" alt=""></a>
                    <div>
                        <span>{{ $post->content }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection