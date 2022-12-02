<nav class="navbar navbar-expand navbar-white bg-white shadow sticky-top">

  <a class="navbar-brand" href="/">Laralove</a>

  <ul class="navbar-nav ml-auto">

    @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
    @endguest

  </ul>

</nav>
