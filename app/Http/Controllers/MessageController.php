<?php

namespace App\Http\Controllers;

use App\Consts\NotificationConst;
use Illuminate\Http\Request;
use App\Room;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\MessageFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Events\MessageAdded;
use App\Events\NotificationAdded;
use App\MessageRead;
use App\Notification;

class MessageController extends Controller
{
    public function send(MessageFormRequest $request)
    {
        //対象のルームを取得
        $room = Room::where('name', $request->name)->firstOrFail();

        //ログインユーザーを取得
        $user = User::find(Auth::id());

        //認可
        $is_participant = $room->isParticipant($user->id);
        //ログインしているユーザーの送信が許可されていない場合
        if (!$is_participant) {
            $res = response()->json([
                'errors' => 'ダイレクトメッセージを送信する権限がありません。',
            ],400);

            throw new HttpResponseException($res);
        }

        //初期化
        $create_data = [];

        //ファイルを取得
        $image = $request->file('input_file');

        //ファイルが存在する場合
        if ($image) {
            //ディレクトリ名
            $dir = 'messages';

            //ストレージに保存
            $store_file_name = basename($image->store('public/' . $dir));

            //データを格納
            $create_data['file_path'] = 'storage/' . $dir . '/' . $store_file_name;
        }

        //メッセージ作成処理
        $create_data['user_id'] = $user->id;
        $create_data['room_id'] = $room->id;
        $create_data['text'] = $request->text;
        $param = Message::create($create_data)->toArray();

        //パラメータにプロフィール画像を追加する
        $param['profile_image_path'] = $user->profile_image_path;

        //パラメータに参加者のIDを追加する
        $param['participant_ids'] = $room->participants()->get(['users.id'])->pluck('id');

        //参加者のルーム/メッセージの既読管理テーブルに未読として保存
        foreach($param['participant_ids'] as $participant_id) {
            //自分が送信したメッセージは既読管理テーブルに保存しない
            if ($participant_id === $user->id) {
                continue;
            }

            //同じルームに未読の通知が存在するかチェック
            $exists_notification = Notification::where('receiver_id', $participant_id)
                                        ->where('sender_id', $user->id)
                                        ->where('event_type', NotificationConst::MESSAGE_SEND_ADDED)
                                        ->where('is_read', false)
                                        ->exists();

            //存在する場合は処理終了/存在しない場合は新規作成
            if (!$exists_notification) {
                $notification = Notification::create([
                    'receiver_id' => $participant_id,
                    'sender_id' => $user->id,
                    'event_type' => NotificationConst::MESSAGE_SEND_ADDED,
                    'message' => $user->name . NotificationConst::MESSAGE_FROM,
                    'is_read' => false
                ]);

                // Pusherのイベント処理
                event(new NotificationAdded($notification));
            }

            //メッセージの既読管理を新規作成/更新
            MessageRead::firstOrCreate(
                ['user_id' => $participant_id, 'room_id' => $room->id, 'is_read' => false],
                ['message_id' => $param['id']]
            );
        }

        //pusherのイベント処理
        event(new MessageAdded($param));

        //メッセージのJsonを返す
        return response()->json($param);
    }

    //最新メッセージを取得する
    public function getLatest(Request $request, Room $room)
    {
        //対象のルームを取得
        $room = $room->where('name', $request->name)->first();

        //対象のルームが存在しない場合
        if (!$room) {
            $res = response()->json([
                'errors' => '対象のメッセージが存在しません。',
            ],
            400);

            throw new HttpResponseException($res);
        }

        //最新のメッセージを取得
        $param = $room->getLatestMessages()->toArray();

        Log::debug($param);

        ///メッセージのJsonを返す
        return response()->json(array_values($param));
    }
}
