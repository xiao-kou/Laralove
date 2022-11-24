@extends('app')

@section('title', 'Laralove | Room index')

@section('content')

@include('nav')

<div class="container">
    <div class="d-flex justify-content-start align-items-center mt-3">
        <a href=""><img src="" alt="" class="rounded-circle circle-sm"></a>
        <div class="ml-4">
            <div class="d-flex align-items-center">
                <h5>ユーザー名</h5>
                <h6 class="ml-3 mb-2 text-muted">スクリーンID</h6>
            </div>
            <div>メッセージの内容</div>
        </div>
    </div>
    <hr>
</div>
@endsection
