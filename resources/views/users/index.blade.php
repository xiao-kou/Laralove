@extends('app')

@section('title', 'ユーザー一覧')

@section('content')

@include('nav')

<div class="container">
    @foreach($users as $user)
        <div class="d-flex justify-content-start align-items-center mt-3">
            <a href="{{ route('users.show', $user->id) }}"><img src="{{ asset($user->profile_image_path) }}" alt="" class="rounded-circle circle-sm"></a>
            <div class="ml-4">
                <div class="d-flex align-items-center">
                    <h4>{{ $user->name }}</h4>
                    <button class="btn btn-primary btn-sm ml-3 mb-2" onclick="location.href='{{ route('message.show', ['1', '2'] ) }} '">DMを送る</button>
                </div>
                <span>{{ '@' . $user->screen_name }}</span>
            </div>
        </div>
        <hr>
    @endforeach
</div>
@endsection