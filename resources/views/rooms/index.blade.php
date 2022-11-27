@extends('app')

@section('title', 'Laralove | Room index')

@section('content')

@include('nav')

<div class="container">
    @foreach($rooms as $room)
        <div class="d-flex justify-content-start align-items-center mt-3">
            <a href="{{ route('users.show', $room->sender_id) }}" class="text-decoration-none text-body">
                <img src="{{ asset($room->sender_profile_image_path) }}" alt="" class="rounded-circle circle-sm">
            </a>
            <a href="{{ route('rooms.show', $room->name) }}" class="text-decoration-none text-body">
                <div class="ml-4">
                    <div class="d-flex align-items-center">
                        <h5>{{$room->sender_name}}</h5>
                        <h6 class="ml-3 mb-2 text-muted">{{'@'.$room->sender_screen_name}}</h6>
                        @if (!$room->message_read)
                            <h6 class="ml-3 mb-2 text-danger">新着</h6>
                        @endif
                    </div>
                    <div>{{$room->message_text}}</div>
                </div>
            </a>
        </div>
        <hr>
    @endforeach
</div>
@endsection
