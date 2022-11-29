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
        $rooms = DB::table('users')
                        ->select(DB::raw('users.id as friend_id,
                                users.profile_image_path as friend_profile_image_path,
                                users.name as friend_name,
                                users.screen_name as friend_screen_name,
                                messages.text as message_text,
                                messages.user_id as sender_id,
                                messages.file_path as message_file_path,
                                rooms.name as name,
                                message_reads.is_read as message_read'))
                        ->leftJoin('user_room', 'users.id', '=', 'user_room.user_id')
                        ->leftJoin('rooms', 'user_room.room_id', '=', 'rooms.id')
                        ->leftJoin('messages', 'rooms.id', '=', 'messages.room_id')
                        ->leftJoin('message_reads', 'messages.id', '=', 'message_reads.message_id')
                        ->whereIn('messages.id', function($q) {
                            //サブクエリでONLY_FULL_GROUP_BYを対処
                            return $q->from('messages')
                                    ->selectRaw('MAX(id) as max_id')
                                    ->groupBy('room_id');
                        })
                        ->whereIn('rooms.id', function($q) {
                            return $q->from('user_room')
                                    ->select('user_room.room_id')
                                    ->where('user_id', Auth::id());
                        })
                        ->where('users.id', '<>', Auth::id())
                        ->orderBy('messages.created_at', 'DESC')
                        ->get();

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
                                        users.name as user_name,
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
