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
                                <button class="btn btn-primary btn-sm ml-3 mb-2 py-0" onclick="location.href='{{ route('rooms.show', implode('-', $participant_ids) ) }} '">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                                        <line x1="8" y1="9" x2="16" y2="9"></line>
                                        <line x1="8" y1="13" x2="14" y2="13"></line>
                                    </svg>
                                </button>
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