<nav class="navbar navbar-expand navbar-dark bg-primary">

  <a class="navbar-brand" href="/">Laralove</a>

  <ul class="navbar-nav ml-auto">

    @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.create') }}"><i class="mr-1"></i>投稿する</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}"><i class="mr-1"></i>ユーザー一覧</a>
      </li>
    @endauth

    @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
    @endguest

    @auth
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          @auth
            <button class="dropdown-item" type="button"
                    onclick="location.href='{{ route('user.show', auth()->id()) }}'">
              マイページ
            </button>
          @endauth
          <div class="dropdown-divider"></div>
          <button form="logout-button" class="dropdown-item" type="submit">
            ログアウト
          </button>
        </div>
      </li>
      <form id="logout-button" method="POST" action="{{ route('logout') }}" class="d-none">
          @csrf
      </form>
      <!-- Dropdown -->
    @endauth

  </ul>

</nav>
