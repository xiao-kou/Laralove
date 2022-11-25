<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            //ログインしていない場合は変数を定義せずに終了
            if (!Auth::check()) {
                return false;
            }

            //新着メッセージ通知で使用する、ログインユーザーが参加しているルームのIDをグローバル変数として取得
            $notifications = DB::table('room_reads')
                            ->selectRaw('GROUP_CONCAT(DISTINCT room_id) as room_ids')
                            ->groupBy('user_id')
                            ->where('user_id', Auth::id())
                            ->where('read', false)
                            ->first();

            $view->with('notifications', $notifications);
        });
    }
}
