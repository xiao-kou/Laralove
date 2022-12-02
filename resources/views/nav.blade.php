<nav class="navbar navbar-expand navbar-white bg-white shadow sticky-top">

  <a class="navbar-brand" href="/">Laralove</a>

  <ul class="navbar-nav ml-auto">

    @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.create') }}"><i class="mr-1"></i>投稿する</a>
      </li>
      <li class="nav-item">
        <a class="nav-link message" href="{{ route('rooms.index') }}"><i class="mr-1"></i>
          メッセージ
        </a>
        <div class="unread d-none">
          <span class="count text-white"></span>
        </div>
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
          <button class="dropdown-item" type="button"
                  onclick="location.href='{{ route('users.show', auth()->id()) }}'">
            マイページ
          </button>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item" type="button"
                    onclick="location.href='{{ route('users.index') }}'">
              ユーザー一覧
            </button>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item" type="button"
                    onclick="location.href='{{ route('users.edit', auth()->id()) }}'">
              ユーザー設定
            </button>
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
