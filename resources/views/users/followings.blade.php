@extends('app')

@section('title', 'Laralove | User Following')

@section('content')

@include('nav')

<div class="container">
    @foreach($followings as $following)
        <div class="d-flex justify-content-start align-items-center mt-3">
            <a href="{{ route('users.show', $following->id) }}"><img src="{{ asset($following->profile_image_path) }}" alt="" class="rounded-circle circle-sm"></a>
            <div class="ml-4">
                <div class="d-flex align-items-center">
                    <h4>{{ $following->name }}</h4>
                    <button class="btn btn-primary btn-sm ml-3 mb-2" onclick="location.href='{{ route('rooms.show', [auth()->id(), $following->id] ) }} '">DMを送る</button>
                </div>
                <span>{{ '@' . $following->screen_name }}</span>
            </div>
        </div>
        <hr>
    @endforeach
</div>
@endsection