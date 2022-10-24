@extends('app')

@section('title', 'ユーザー一覧')

@section('content')

@include('nav')

<div class="container">
    <div class="d-flex justify-content-start align-items-center mt-3">
        <a href="{{ route('user.show', '1') }}"><img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-sm"></a>
        <div class="ml-5">
            <div class="d-flex align-items-center">
                <h4>ユーザー名</h4>
                <button class="btn btn-primary btn-sm ml-3 mb-2" onclick="location.href='{{ route('message.show', ['1', '2'] ) }} '">DMを送る</button>
            </div>
            <span>スクリーンID</span>
        </div>
    </div>
    <hr>
    <div class="d-flex fustify-content-start align-items-center">
        <a href="{{ route('user.show', '1') }}"><img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-sm"></a>
        <div class="ml-5">
            <div class="d-flex align-items-center">
                <h4>ユーザー名</h4>
                <button class="btn btn-primary btn-sm ml-3 mb-2" onclick="location.href='{{ route('message.show', ['1', '2'] ) }} '">DMを送る</button>
            </div>
            <span>スクリーンID</span>
        </div>
    </div>
    <hr>
    <div class="d-flex fustify-content-start align-items-center">
        <a href="{{ route('user.show', '1') }}"><img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-sm"></a>
        <div class="ml-5">
            <div class="d-flex align-items-center">
                <h4>ユーザー名</h4>
                <button class="btn btn-primary btn-sm ml-3 mb-2" onclick="location.href='{{ route('message.show', ['1', '2'] ) }} '">DMを送る</button>
            </div>
            <span>スクリーンID</span>
        </div>
    </div>
</div>

@endsection