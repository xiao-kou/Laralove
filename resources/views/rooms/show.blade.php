@extends('app')

@section('title', 'Laralove | Message Show')

@section('content')

@include('nav')

<!-- ajax用のheader -->
<meta name="csrf-token" content="{{ csrf_token() }}" data-user-id="{{ auth()->id() }}">
<div class="container">
    <div id="message_data" class="mb-5 pb-5">
        @foreach($user_messages as $user_message)
            <!-- 自分が送信したメッセージの場合 -->
            @if ($user_message->id === auth()->id())
                @if ($user_message->pivot->text)
                    <div class="d-flex flex-row-reverse align-items-center mt-3">
                        <div class="balloon-right">
                            <h5 class="text-center">{{ $user_message->pivot->text }}</h5>
                        </div>
                    </div>
                @endif
                @if ($user_message->pivot->file_path)
                    <div class="d-flex flex-row-reverse align-items-center mt-3">
                        <div class="balloon-right w-50 text-center">
                            <img src="{{ asset($user_message->pivot->file_path) }}" alt="" class="w-100">
                        </div>
                    </div>
                @endif
            @else
                @if ($user_message->pivot->text)
                    <div class="d-flex justify-content-start align-items-center mt-3">
                        <a href="{{ route('users.show', $user_message->id) }}">
                            <img src="{{ asset($user_message->profile_image_path) }}" alt="" class="rounded-circle circle-sm mr-2">
                        </a>
                        <div class="balloon-left">
                            <h5 class="text-center">{{ $user_message->pivot->text }}</h5>
                        </div>
                    </div>
                @endif
                @if ($user_message->pivot->file_path)
                    <div class="d-flex justify-content-start align-items-center mt-3">
                        <a href="{{ route('users.show', $user_message->id) }}">
                            <img src="{{ asset($user_message->profile_image_path) }}" alt="" class="rounded-circle circle-sm mr-2">
                        </a>
                        <div class="balloon-left w-50 text-center">
                            <img src="{{ asset($user_message->pivot->file_path) }}" alt="" class="w-100">
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
    <form id="form_message" class="">
        <div class="form-fixed-bottom row d-flex align-items-center">
            <div class="ml-3 pr-0">
                <button type="button" class="px-0 w-100 d-block" id="btn_attach_image">
                    <img src="https://placehold.jp/500x500.png" alt="" class="w-100" style="height: 30px;">
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
    </form>
</div>

@endsection
