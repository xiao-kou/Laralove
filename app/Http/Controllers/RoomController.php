<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageRead;
use App\Notification;
use Illuminate\Http\Request;
use App\Room;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = DB::table('user_room')
                        ->select(DB::raw('users.id as sender_id,
                                users.profile_image_path as sender_profile_image_path,
                                users.name as sender_name,
                                users.screen_name as sender_screen_name,
                                messages.text as message_text,
                                messages.file_path as message_file_path,
                                rooms.name as name,
                                message_reads.is_read as message_read'))
                        ->leftJoin('rooms', 'user_room.room_id', '=', 'rooms.id')
                        ->leftJoin('messages', 'user_room.room_id', '=', 'messages.room_id')
                        ->leftJoin('users', 'messages.user_id', '=', 'users.id')
                        ->leftJoin('message_reads', 'messages.id', '=', 'message_reads.message_id')
                        ->whereIn('messages.id', function($q) {
                            //サブクエリでONLY_FULL_GROUP_BYを対処
                            return $q->from('messages')
                                    ->selectRaw('MAX(id) as max_id')
                                    ->groupBy('room_id');
                        })
                        ->where('user_room.user_id', Auth::id())
                        ->orderBy('messages.created_at', 'DESC')
                        ->get();
                        // dd($rooms->toArray());

        //notificationsを既読に変更
        Notification::where('receiver_id', Auth::id())->update(['is_read' => true]);

        return view('rooms.index', compact('rooms'));
    }

    public function show($name)
    {
        //Roomが存在ない場合は新規で作成をする
        $room = Room::firstOrCreate([
            'name' => $name
        ]);

        //中間テーブルにデータを格納
        $user_ids = explode('-', $name);
        $room->participants()->syncWithoutDetaching($user_ids);

        //ユーザーとメッセージを取得
        $user_messages = $room->users()
                                ->select(DB::raw('users.id as user_id,
                                        users.profile_image_path as profile_image_path,
                                        messages.id as message_id,
                                        messages.text as message_text,
                                        messages.file_path as file_path
                                '))
                                ->orderBy('messages.created_at', 'DESC')
                                ->take(50)
                                ->get()
                                ->sortBy('pivot.created_at');

        //未読のメッセージIDを取得
        $unread_id = MessageRead::where('user_id', Auth::id())
                                ->where('is_read', false)
                                ->first();

        //メッセージを既読に変更
        MessageRead::where('user_id', Auth::id())->update(['is_read' => true]);

        return view('rooms.show', compact('user_messages', 'unread_id'));
    }
}
