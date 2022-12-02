@extends('app')

@section('title', 'Laralove | Profile Settings')

@section('content')

@include('nav')

<div class="container-fluid pl-0">
    <div class="row">
        @include('sidebar')
        <div class="col">
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">プロフィールを設定</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('users.profile_update', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="text-center mb-4 border" id="profile_image_settings_area">
                                    <h6 class="mt-3">プロフィール画像を選択</h6>
                                    <img src="{{ asset($user->profile_image_path) }}"  alt="" class="rounded-circle circle-lg mb-1" id="profile_image">
                                </div>

                                <input type="file" name="input_image" class="d-none" accept="image/png, image/jpeg, image/jpg, image/gif">

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="introduction" class="col-md-4 col-form-label text-md-right">自己紹介</label>

                                    <div class="col-md-6">
                                        <textarea name="introduction" id="introduction" cols="20" rows="3" class="form-control @error('introduction') is-invalid @enderror">{{ $user->introduction }}</textarea>

                                        @error('introduction')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="location" class="col-md-4 col-form-label text-md-right">場所</label>

                                    <div class="col-md-6">
                                        <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $user->location) }}">

                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sex" class="col-md-4 col-form-label text-md-right">性別</label>

                                    <div class="col-md-6">
                                        <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror" required>
                                            @foreach(App\Consts\SexConst::List as $key => $value)
                                                <option value="{{ $key }}" @if ($user->sex == $key) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>

                                        @error('sex')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            保存する
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
