<?php

namespace App\Http\Middleware;

use Closure;
use App\Room;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckForParticipant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Roomが存在する場合
        $room = Room::where('name', $request->name)->first();
        if ($room) {
            $is_participant = $room->participants()->newPivotQuery()->where('user_id', Auth::id())->exists();
            return $is_participant
                        ? $next($request)
                        : redirect()->back()->with('このダイレクトメッセージにアクセスする権限がありません。');
        }

        //Roomが存在しない場合
        //２つのユーザーが存在するかを確認
        $user_ids = explode('-', $request->name);
        $user_count = User::find($user_ids)->count();
        if ($user_count != 2){
            return redirect()->back()->with('対象のユーザーが存在しません。');
        }

        //パラメータにログインユーザーのidが含まれているかを確認
        $is_participant = in_array((string) Auth::id(), $user_ids, true);
        if (!$is_participant) {
            return redirect()->back()->with('このダイレクトメッセージにアクセスする権限がありません。');
        }

        return $next($request);
    }
}
