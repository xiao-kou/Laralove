<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

    <title>@yield('title')</title>
  </head>
  <body>
    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/validation.js') }}"></script>
    @if (Request::route()->getName() === 'rooms.show')
      <script src="{{ asset('js/messages.js') }}"></script>
    @endif

    <!-- Select2 JS -->
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <!-- フラッシュメッセージ -->
    @if (session('flash_message'))
      <div class="flash_message bg-success text-center py-3 my-0 text-white fixed-top" role="alert">
        {{ session('flash_message') }}
      </div>
    @endif

    @yield('content')
  </body>
</html>
