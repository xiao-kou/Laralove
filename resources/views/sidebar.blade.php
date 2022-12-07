<div class="col-2 bg-primary pr-0">
    <div class="sidebar_fixed">
        @guest
            <div class="pt-3 pb-1 item">
                <a href="{{ route('login') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/login.svg') }}" alt="login">
                    <h5 class="pt-2 d-md-block d-none">ログイン</h5>
                </a>
            </div>
            <div class="pt-3 mb-1 item">
                <a href="{{ route('register') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/user-plus.svg') }}" alt="user-plus">
                    <h5 class="pt-2 d-md-block d-none">ユーザー登録</h5>
                </a>
            </div>
        @endguest
        @auth
            <div class="pt-3 pb-1 item">
                <a href="{{ route('posts.index') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/home.svg') }}" alt="home">
                    <h5 class="pt-2 d-md-block d-none">ホーム</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('users.show', auth()->id()) }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/user.svg') }}" alt="user">
                    <h5 class="pt-2 d-md-block d-none">マイページ</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('posts.create') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/photo-plus.svg') }}" alt="photo-plus">
                    <h5 class="pt-2 d-md-block d-none">投稿する</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('rooms.index') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <div>
                        <img src="{{ asset('images/message.svg') }}" alt="message" class="message">
                        <div class="unread count d-none"></div>
                    </div>
                    <h5 class="pt-2 d-md-block d-none">メッセージ</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('users.index') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/users.svg') }}" alt="users">
                    <h5 class="pt-2 d-md-block d-none">ユーザー一覧</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('users.edit', auth()->id()) }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/settings.svg') }}" alt="">
                    <h5 class="pt-2 d-md-block d-none">設定</h5>
                </a>
            </div>
            <button form="logout-button" type="submit" class="text-decoration-none border-0 bg-primary text-white pt-3 pb-1 item w-100 d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/logout.svg') }}" alt="">
                <h5 class="pt-2 d-md-block d-none">ログアウト</h5>
            </button>
            <form id="logout-button" method="POST" action="{{ route('logout') }}" class="d-none">
                    @csrf
            </form>
        @endauth
    </div>
</div>
