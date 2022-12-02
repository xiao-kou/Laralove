@extends('app')

@section('title', 'Laralove | User Follower')

@section('content')

@include('nav')

<div class="container-fluid pl-0">
    <div class="row">
        @include('sidebar')
        <div class="col">
            @foreach($followers as $follower)
                <div class="d-flex justify-content-start align-items-center mt-3">
                    <a href="{{ route('users.show', $follower->id) }}"><img src="{{ asset($follower->profile_image_path) }}" alt="" class="rounded-circle circle-sm"></a>
                    <div class="ml-4">
                        <div class="d-flex align-items-center">
                            <h4>{{ $follower->name }}</h4>
                            @php
                                $participant_ids = [auth()->id(), $follower->id];
                                sort($participant_ids);
                            @endphp
                            @if ($follower->id !== auth()->id())
                                <button class="btn btn-primary btn-sm ml-3 mb-2" onclick="location.href='{{ route('rooms.show', implode('-', $participant_ids) ) }} '">DMを送る</button>
                            @endif
                        </div>
                        <span>{{ '@' . $follower->screen_name }}</span>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>

@endsection