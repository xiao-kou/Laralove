@extends('app')

@section('title', 'Laralove | Room index')

@section('content')

@include('nav')

<div class="container">
    @foreach($rooms as $room)
        <div class="d-flex justify-content-start align-items-center mt-3">
            <a href="{{ route('users.show', $room->friend_id) }}" class="text-decoration-none text-body">
                <img src="{{ asset($room->friend_profile_image_path) }}" alt="" class="rounded-circle circle-sm">
            </a>
            <a href="{{ route('rooms.show', $room->name) }}" class="text-decoration-none text-body">
                <div class="ml-4">
                    <div class="d-flex align-items-center">
                        <h5>{{$room->friend_name}}</h5>
                        <h6 class="ml-3 mb-2 text-muted">{{'@'.$room->friend_screen_name}}</h6>
                        @if ($room->sender_id !== auth()->id())
                            @if (!$room->message_read)
                                <h6 class="ml-3 mb-2 text-danger">新着</h6>
                            @endif
                        @endif
                    </div>
                    <div>{{$room->message_text}}</div>
                    @if ($room->message_file_path)
                        @if ($room->sender_id === auth()->id())
                            <div>画像を送信しました</div>
                        @else
                            <div>画像が送信されました</div>
                        @endif
                    @endif
                </div>
            </a>
        </div>
        <hr>
    @endforeach
</div>
@endsection
