@extends('app')

@section('title', 'Laralove | User Edit')

@section('content')

@include('nav')

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card user_edit">
                <div class="card-header">ユーザー情報を設定</div>
                <ul class="nav nav-tabs d-flex justify-content-around">
                    <li class="nav-item" id="nav_screen_name" data-tab="#tab_screen_name">
                        <a href="#tab_screen_name" class="nav-link @if (!$errors->has('email') && !$errors->has('current_password') && !$errors->has('new_password') ) active @endif" data-toggle="tab">ユーザー名</a>
                    </li>
                    <li class="nav-item" data-tab="#tab_email">
                        <a href="#tab_email" class="nav-link @if ($errors->has('email')) active @endif " data-toggle="tab">メールアドレス</a>
                    </li>
                    <li class="nav-item" data-tab="#tab_password">
                        <a href="#tab_password" class="nav-link @if ($errors->has('current_password') || $errors->has('new_password')) active @endif" data-toggle="tab">パスワード</a>
                    </li>
                </ul>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}" class="tab-content">
                        @csrf
                        @method('PUT')

                        <div id="tab_screen_name" class="tab-pane @if (!$errors->has('email') && !$errors->has('current_password') && !$errors->has('new_password') ) d-block active @endif">
                            <div class="form-group row">
                                <label for="screen_name" class="col-md-4 col-form-label text-md-right">ユーザー名</label>

                                <div class="col-md-6">
                                    <input id="screen_name" type="text" class="form-control @error('screen_name') is-invalid @enderror" name="screen_name" value="{{ old('screen_name', $user->screen_name) }}", @if ($errors->has('email') || $errors->has('current_password') || $errors->has('new_password')) disabled="disabled" @endif required>

                                    @error('screen_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="tab_email" class="tab-pane @if ($errors->has('email')) d-block active @endif">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" @if (!$errors->has('email')) disabled="disabled @endif" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="tab_password" class="tab-pane @if ($errors->has('current_password') || $errors->has('new_password')) d-block active @endif">
                            <div class="form-group row">
                                <label for="current-password" class="col-md-4 col-form-label text-md-right">現在のパスワード</label>

                                <div class="col-md-6">
                                    <input id="current-password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" @if(!$errors->has('current_password') && !$errors->has('new_password')) disabled="disabled" @endif required>

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">新しいパスワード</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" @if(!$errors->has('current_password') && !$errors->has('new_password')) disabled="disabled" @endif required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    編集する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
