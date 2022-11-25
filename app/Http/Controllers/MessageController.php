<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\MessageFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Events\MessageAdded;
use App\MessageRead;

class MessageController extends Controller
{
    public function send(MessageFormRequest $request, User $user)
    {
        //対象のルームを取得
        $room = Room::where('name', $request->name)->firstOrFail();

        //認可
        $is_participant = $room->isParticipant(Auth::id());
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
        $create_data['user_id'] = Auth::id();
        $create_data['room_id'] = $room->id;
        $create_data['text'] = $request->text;
        $param = Message::create($create_data)->toArray();

        //パラメータにプロフィール画像を追加する
        $param['profile_image_path'] = $user->getProfileImage(Auth::id());

        //パラメータに参加者のIDを追加する
        $param['participant_ids'] = $room->participants()->get(['users.id'])->pluck('id');

        //参加者のメッセージの既読管理テーブルに未読として保存
        foreach($param['participant_ids'] as $participant_id) {
            //自分が送信したメッセージは既読管理テーブルに保存しない
            if ($participant_id === Auth::id()) {
                continue;
            }

            MessageRead::create([
                'user_id' => $participant_id,
                'room_id' => $room->id,
                'message_id' => $param['id'],
                'read' => false,
            ]);
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
