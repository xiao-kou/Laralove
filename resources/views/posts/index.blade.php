@extends('app')

@section('title', 'Laralove | Home')

@section('content')

@include('nav')
<div class="container">
    <div class="row d-flex mt-1">
        @foreach($posts as $post)
            <div class="col-4">
                <a href="{{ route('post.show', ['id' => $post->id]) }}"><img src="{{ asset($post->file_path) }}" class="w-100" alt="..."></a>
            </div>
        @endforeach
    </div>
</div>

@endsection