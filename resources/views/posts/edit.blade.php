@extends('app')

@section('title', 'Laralove | Post Edit')

@section('content')

@include('nav')

<div class="container">
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group row mt-4">
            <label for="title" class="col-md-4 col-form-label text-md-right">タイトル</label>

            <div class="col-md-6">
                <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $post->title }}" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="content" class="col-md-4 col-form-label text-md-right">内容</label>

            <div class="col-md-6">
                <textarea required name="content" id="content" rows="3" class="form-control @error('content') is-invalid @enderror">{{ $post->content }}</textarea>
            </div>
        </div>

        <div class="form-group row input-file">
            <label for="file" class="col-md-4 col-form-label text-md-right">ファイル</label>
            <div id="file" class="input-group col-md-6">
                <div class="custom-file">
                    <input type="file" id="cutomfile" class="custom-file-input" name="input_file"  accept="image/png, image/jpeg, image/jpg, image/gif"/>
                    <label class="custom-file-label" for="customfile" data-browse="画像編集">使用中のファイル</label>
                </div>
            </div>
        </div>
        <div id="preview" class="row">
            <div class="d-inline-block mb-2 col-md-12 text-center">
                <img class="img-thumbnail" src="{{ asset($post->file_path) }}"style="height:150px;" />
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-secondary mr-2">投稿を削除する</button>
                <button type="submit" class="btn btn-primary">投稿を更新する</button>
            </div>
        </div>
    </form>
</div>

@endsection