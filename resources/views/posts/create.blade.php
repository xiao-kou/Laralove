@extends('app')

@section('title', 'Laralove | Post Create')

@section('content')

@include('nav')

<div class="container-fluid pl-0">
    <div class="row">
        @include('sidebar')
        <div class="col">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group row mt-4">
                    <label for="title" class="col-md-4 col-form-label text-md-right">タイトル</label>

                    <div class="col-md-6">
                        <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>

                        <span class="invalid-feedback title">
                            <strong>タイトルは30文字以内で入力してください。</strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-md-4 col-form-label text-md-right">内容</label>

                    <div class="col-md-6">
                        <textarea required name="content" id="content" rows="3" class="form-control @error('content') is-invalid @enderror"></textarea>

                        <span class="invalid-feedback content">
                            <strong>内容は255文字以内で入力してください。</strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row input-file">
                    <label for="file" class="col-md-4 col-form-label text-md-right">ファイル</label>
                    <div id="file" class="input-group col-md-6">
                        <div class="custom-file">
                            <input type="file" id="cutomfile" class="custom-file-input"  name="input_file" required accept="image/png, image/jpeg, image/jpg, image/gif"/>
                            <label class="custom-file-label" for="customfile" data-browse="参照">ファイル選択...</label>
                        </div>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary reset">取消</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 text-right">
                        <button type="submit" class="btn btn-primary">投稿する</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
