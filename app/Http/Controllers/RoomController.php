<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Illuminate\Support\Facades\Auth;
use App\Policies\RoomPolicy;
use App\UserRoom;

class RoomController extends Controller
{
    public function show($name)
    {
        //認可
        //Roomが存在ない場合は新規で作成をする
        $room = Room::firstOrCreate([
            'name' => $name
        ]);

        //中間テーブルにデータを格納
        $user_ids = explode('-', $name);
        $room->participants()->syncWithoutDetaching($user_ids);

        //ユーザーとメッセージを取得
        $user_messages = $room->users()
                                ->orderBy('messages.created_at', 'DESC')
                                ->take(50)
                                ->get()
                                ->sortBy('pivot.created_at');

        return view('rooms.show', compact('user_messages'));
    }
}
