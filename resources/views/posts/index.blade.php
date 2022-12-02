@extends('app')

@section('title', 'Laralove | Home')

@section('content')

@include('nav')

<div class="container-fluid pl-0">
    <div class="row">
        @include('sidebar')
        <div class="col">
            <div class="row d-flex align-items-center mt-1">
                @foreach($posts as $post)
                    <div class="col-md-8 offset-md-2 card my-3 bg-light">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}"><img src="{{ asset($post->file_path) }}" class="w-100" alt="..."></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection