<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        //いいね登録処理
        Auth::user()->likes()->syncWithoutDetaching($request->post_id);

        //いいねの数を取得
        $likes_count = Post::find($request->post_id)->likes()->count();
        $param = [
            'likes_count' => $likes_count
        ];

        return response()->json($param);
    }

    public function destroy(Request $request)
    {
        //いいね解除処理
        Auth::user()->likes()->detach($request->post_id);

        //いいねの数を取得
        $likes_count = Post::find($request->post_id)->likes()->count();
        $param = [
            'likes_count' => $likes_count
        ];

        return response()->json($param);
    }
}
