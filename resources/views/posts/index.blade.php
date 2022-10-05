@extends('app')

@section('title', 'Laralove | Home')

@section('content')

@include('nav')
<div class="container" style="overflow-x:scroll;">
    <div class="row d-flex mt-1">
        <div class="col-4">
            <img src="https://placehold.jp/500x500.png" class="w-100" alt="...">
        </div>
        <div class="col-4">
            <img src="https://placehold.jp/500x500.png" class="w-100" alt="...">
        </div>
        <div class="col-4">
            <img src="https://placehold.jp/500x500.png" class="w-100" alt="...">
        </div>
    </div>
</div>

@endsection