<div class="col-2 bg-primary pr-0">
    <div class="sidebar_fixed">
        <div class="pt-3 pb-1 item">
            <a href="{{ route('posts.index') }}" class="text-white text-center text-decoration-none">
                <h5>ホーム</h5>
            </a>
        </div>
        @auth
            <div class="pt-3 pb-1 item">
                <a href="{{ route('users.show', auth()->id()) }}" class="text-white text-center text-decoration-none">
                    <h5>マイページ</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('posts.create') }}" class="text-white text-center text-decoration-none">
                    <h5>投稿する</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('rooms.index') }}" class="text-white text-center text-decoration-none">
                    <h5>メッセージ</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('users.index') }}" class="text-white text-center text-decoration-none">
                    <h5>ユーザー一覧</h5>
                </a>
            </div>
            <div class="pt-3 pb-1 item">
                <a href="{{ route('users.show', auth()->id()) }}" class="text-white text-center text-decoration-none">
                    <h5>設定</h5>
                </a>
            </div>
            <button form="logout-button" type="submit" class="text-decoration-none border-0 bg-primary text-white item w-100">
                <div class="pt-3 pb-1">
                    <h5>ログアウト</h5>
                </div>
            </button>
            <form id="logout-button" method="POST" action="{{ route('logout') }}" class="d-none">
                    @csrf
            </form>
        @endauth
    </div>
</div>
