@extends('app')

@section('title', 'Laralove | Verification Resend')

@section('content')

@include('nav')

<div class="container-fluid pl-0">
    <div class="row">
        @include('sidebar')
        <div class="col">
            <div class="row justify-content-center mt-3">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('メールアドレスを確認してください。') }}</div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('新しい確認リンクがメールアドレスに送信されました。') }}
                                </div>
                            @endif

                            <div>
                                {{ __('メールに送信されたリンクから本登録を行なってください。') }}
                            </div>
                            {{ __('メールが届かない場合は、') }}
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('ここをクリックして確認リンクを再送信する。') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
