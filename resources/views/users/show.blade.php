@extends('app')

@section('title', 'User Show')

@section('content')

@include('nav')

<!-- ajax用のheader -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid pl-0">
    <div class="row">
        @include('sidebar')
        <div class="col">
            <div class="d-flex justify-content-center align-items-center mt-3">
                <img src="{{ asset($user->profile_image_path) }}" alt="" class="rounded-circle circle-md">
                <div>
                    <h4 class="my-0 ml-4">{{ $user->name }}</h4>
                    <h5 class="my-1 ml-4">{{ '@' . $user->screen_name }}</h5>
                    @can('follow', $user)
                        @if ($is_following)
                            <button class="mt-1 ml-4 btn btn-secondary btn-sm btn_unfollow" data-user-id="{{ $user->id }}">フォロー中</button>
                        @else
                            <button class="mt-1 ml-4 btn btn-primary btn-sm btn_follow" data-user-id="{{ $user->id }}" >フォロー</button>
                        @endif
                    @endcan
                    @can('update', $user)
                        <button class="ml-4 mt-1 btn btn-primary btn-sm d-block" onclick="location.href = '{{ route('users.profile_settings', $user->id) }}'">プロフィール設定</button>
                    @endcan
                </div>
            </div>
            <div class="d-flex row justify-content-center align-items-center mt-3">
                <h6 class="col-md-5">
                    {{ $user->introduction }}
                </h6>
            </div>
            <div class="d-flex row justify-content-center align-items-center mt-2">
                <h6 class="col-md-4">
                    {{ $user->location }}
                </h6>
                <h6 class="col-md-1">
                    {{ App\Consts\SexConst::List[$user->sex] }}
                </h6>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-2">
                <a href="{{ route('users.followings', $user->id) }}" class="mr-4 text-secondary"><span id="followings_count">{{ $followings_count }}</span><span> フォロー中</span></a>
                <a href="{{ route('users.followers', $user->id) }}" class="text-secondary"><span id="followers_count">{{ $followers_count }}</span><span> フォロワー</span></a>
            </div>
            <hr>
            <ul class="nav nav-tabs nav-pills d-flex justify-content-around">
                <li class="nav-item">
                    <a href="#photo" class="nav-link active" data-toggle="tab">写真</a>
                </li>
                <li class="nav-item">
                    <a href="#like" class="nav-link" data-toggle="tab">いいね</a>
                </li>
            </ul>
            <hr>
            <div class="tab-content">
                <div id="photo" class="tab-pane active">
                    <div class="d-flex row align-items-center">
                        @foreach($user->posts as $post)
                            <div class="col-4">
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}"><img src="{{ asset($post->file_path) }}" class="w-100" alt="..."></a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="like" class="tab-pane">
                    <div class="d-flex row align-items-center">
                        @foreach($user->likes as $liking_post)
                            <div class="col-4">
                                <a href="{{ route('posts.show', ['post' => $liking_post->id]) }}"><img src="{{ asset($liking_post->file_path) }}" class="w-100" alt="..."></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
