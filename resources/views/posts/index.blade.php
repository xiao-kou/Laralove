@extends('app')

@section('title', 'Laralove | Home')

@section('content')

@include('nav')
<div class="container">
    <div class="row d-flex mt-1">
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

@endsection