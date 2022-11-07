@extends('app')

@section('titile', 'Laralove | Message Show')

@section('content')

@include('nav')

<div class="container">
    <div class="d-flex justify-content-start align-items-center mt-3">
        <a href="{{ route('users.show', '1') }}"><img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-sm mr-2"></a>
        <div class="balloon-left">
            <h5>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h5>
        </div>
    </div>
    <div class="d-flex flex-row-reverse align-items-center mt-3">
        <a href="{{ route('users.show', '1') }}"><img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-sm ml-2"></a>
        <div class="balloon-right">
            <h5>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h5>
        </div>
    </div>
    <div class="d-flex flex-row-reverse align-items-center mt-3">
        <a href="{{ route('users.show', '1') }}"><img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-sm ml-2"></a>
        <div class="balloon-right">
            <h5>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h5>
        </div>
    </div>
    <div class="d-flex flex-row-reverse align-items-center mt-3">
        <a href="{{ route('users.show', '1') }}"><img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-sm ml-2"></a>
        <div class="balloon-right">
            <h5>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h5>
        </div>
    </div>
    <div class="d-flex justify-content-start align-items-center mt-3">
        <a href="{{ route('users.show', '1') }}"><img src="https://placehold.jp/500x500.png" alt="" class="rounded-circle circle-sm mr-2"></a>
        <div class="balloon-left w-50 text-center">
            <img src="https://placehold.jp/500x500.png" alt="" class="w-100">
        </div>
    </div>
    <form method="POST" action="">
        <div class="row form-fixed-bottom">
            <div class="ml-3 pr-0">
                <button type="button" class="px-0 w-100 d-block">
                    <img src="https://placehold.jp/500x500.png" alt="" class="w-100" style="height: 30px;">
                </button>
                <input type="file" class="d-none">
            </div>
            <div class="col-8 ">
                <input id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" required>
            </div>
            <div class="col-2 px-0">
                <button type="submit" class="btn btn-primary">送信</button>
            </div>
        </div>
    </form>
</div>

@endsection
