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

    <title>@yield('title')</title>
  </head>
  <body>
    @yield('content')
  </body>
</html>