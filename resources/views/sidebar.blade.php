<div class="col-2 bg-primary pr-0">
    <div class="sidebar_fixed">
        @guest
            <div class="pt-3 pb-1 item">
                <a href="{{ route('login') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login mb-1" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                        <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
                    </svg>
                    <h5 class="pt-2 d-md-block d-none">ログイン</h5>
                </a>
            </div>
            <div class="pt-3 mb-1 item">
                <a href="{{ route('register') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus mb-1" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 11h6m-3 -3v6"></path>
                    </svg>
                    <h5 class="pt-2 d-md-block d-none">ユーザー登録</h5>
                </a>
            </div>
        @endguest
        @auth
            <div class="pt-3 pb-1 item">
                <a href="{{ route('posts.index') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home mb-1" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                    </svg>
                    <h5 class="pt-2 d-md-block d-none">ホーム</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('users.show', auth()->id()) }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user mb-1" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    </svg>
                    <h5 class="pt-2 d-md-block d-none">マイページ</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('posts.create') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-plus mb-1" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M15 8h.01"></path>
                        <path d="M12 20h-5a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v5"></path>
                        <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l4 4"></path>
                        <path d="M14 14l1 -1c.617 -.593 1.328 -.793 2.009 -.598"></path>
                        <path d="M16 19h6"></path>
                        <path d="M19 16v6"></path>
                    </svg>
                    <h5 class="pt-2 d-md-block d-none">投稿する</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('rooms.index') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message mb-1" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                        <line x1="8" y1="9" x2="16" y2="9"></line>
                        <line x1="8" y1="13" x2="14" y2="13"></line>
                    </svg>
                    <h5 class="pt-2 d-md-block d-none">メッセージ</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('users.index') }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users mb-1" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                    </svg>
                    <h5 class="pt-2 d-md-block d-none">ユーザー一覧</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('users.show', auth()->id()) }}" class="text-white text-center text-decoration-none d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings mb-1" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <h5 class="pt-2 d-md-block d-none">設定</h5>
                </a>
            </div>
            <button form="logout-button" type="submit" class="text-decoration-none border-0 bg-primary text-white pt-3 pb-1 item w-100 d-flex justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout mb-1 ml-1" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                    <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                </svg>
                <h5 class="pt-2 d-md-block d-none">ログアウト</h5>
            </button>
            <form id="logout-button" method="POST" action="{{ route('logout') }}" class="d-none">
                    @csrf
            </form>
        @endauth
    </div>
</div>
