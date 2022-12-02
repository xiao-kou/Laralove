@extends('app')

@section('title', 'Laralove | Room Show')

@section('content')

@include('nav')

<!-- ajax用のheader -->
<meta name="csrf-token" content="{{ csrf_token() }}" data-user-id="{{ auth()->id() }}">
<div class="container">
    <div id="message_data" class="mb-5 pb-5">
        @foreach($user_messages as $user_message)
            <!-- 自分が送信したメッセージの場合 -->
            @if ($user_message->user_id === auth()->id())
                @if ($user_message->message_text)
                    <div class="d-flex flex-row-reverse align-items-center mt-3">
                        <div class="balloon-right">
                            <h5 class="text-center">{{ $user_message->message_text }}</h5>
                        </div>
                    </div>
                @endif
                @if ($user_message->file_path)
                    <div class="d-flex flex-row-reverse align-items-center mt-3">
                        <div class="balloon-right w-50 text-center">
                            <img src="{{ asset($user_message->file_path) }}" alt="" class="w-100">
                        </div>
                    </div>
                @endif
            @else
                @if ($user_message->message_text)
                    <div class="d-flex justify-content-start align-items-center mt-3">
                        <a href="{{ route('users.show', $user_message->user_id) }}" class="mr-2 text-decoration-none">
                            <img src="{{ asset($user_message->profile_image_path) }}" alt="" class="rounded-circle circle-sm">
                            <div class="text-center">{{ $user_message->user_name }}</div>
                        </a>
                        <div class="balloon-left">
                            <h5 class="text-center">{{ $user_message->message_text }}</h5>
                            @if (!is_null($unread_id))
                                @if ($unread_id->message_id <= $user_message->message_id)
                                    <small>
                                        <h6 class="text-right text-danger mt-2 mb-0 small">未読</h6>
                                    </small>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
                @if ($user_message->file_path)
                    <div class="d-flex justify-content-start align-items-center mt-3">
                        <a href="{{ route('users.show', $user_message->user_id) }}" class="mr-2 text-decoration-none">
                            <img src="{{ asset($user_message->profile_image_path) }}" alt="" class="rounded-circle circle-sm">
                            <div class="text-center">{{ $user_message->user_name }}</div>
                        </a>
                        <div class="balloon-left w-50 text-center">
                            <img src="{{ asset($user_message->file_path) }}" alt="" class="w-100">
                            @if (!is_null($unread_id))
                                @if ($unread_id->message_id <= $user_message->message_id)
                                    <div class="text-right text-danger mt-2 mb-0">未読</div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
    <form id="form_message" class="">
        <div class="form-fixed-bottom">
            <div class="d-none row" id="attach_image_area">
                <div class="ml-md-3 col-md-9 bg-primary text-center">
                    <button type="button" class="close" aria-label="Close" id="btn_close">
                        <span>&times;</span>
                    </button>
                    <img src="{{ asset('images/attach_btn.png') }}" alt="" class="w-25">
                </div>
            </div>
            <div class="row d-flex align-items-center">
                <div class="ml-3 pr-0">
                    <button type="button" class="px-0 w-100" id="btn_attach_image">
                        <img src="{{ asset('images/attach_btn.png') }}" alt="" style="height: 30px;">
                    </button>
                    <input type="file" class="d-none" name="input_file" accept="image/png, image/jpeg, image/jpg, image/gif">
                </div>
                <div class="col-8">
                    <textarea required autofocus id="text" rows="3" class="form-control @error('text') is-invalid @enderror" name="text"></textarea>
                </div>
                <input type="text" class="d-none" name="name" value="{{ basename(request()->path()) }}">
                <div class="col-2 px-0">
                    <button type="button" class="btn btn-primary" id="btn_send_message">送信</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
