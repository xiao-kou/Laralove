<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('id')->get();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        //投稿したユーザーを取得
        $user = $post->user()->first();

        //いいねの数を取得
        $likes_count = $post->likes()->count();

        //投稿をいいね中か判定
        $is_liking = $user->is_liking($post->id);

        return view('posts.show', compact('post', 'user', 'likes_count', 'is_liking'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostFormRequest $request)
    {
        //ディレクトリ名
        $dir = 'posts';

        //ストレージに保存
        $store_file_name = basename($request->file('input_file')->store('public/' . $dir));

        //登録処理
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'file_name' => $request->input_file->getClientOriginalName(),
            'file_path' => 'storage/' . $dir . '/' . $store_file_name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('posts.show', $post->id);
    }

    public function edit(Post $post)
    {
        //認可
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(PostFormRequest $request, Post $post)
    {
        //認可
        $this->authorize('update', $post);

        //ファイルを取得
        $image = $request->file('input_file');

        //初期化
        $update_data = [];

        //ファイルが存在する場合
        if ($image) {
            //ディレクトリ名
            $dir = 'posts';

            //現在の画像を削除
            Storage::disk('public')->delete($post->file_path);

            //ストレージに保存
            $store_file_name = basename($image->store('public/' . $dir));

            //データを格納
            $update_data['file_name'] = $image->getClientOriginalName();
            $update_data['file_path'] = 'storage/' . $dir . '/' . $store_file_name;
        }

        //更新処理
        $update_data['title'] = $request->title;
        $update_data['content'] = $request->content;
        $post->update($update_data);

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy(Post $post)
    {
        //認可
        $this->authorize('delete', $post);

        //削除処理
        $post->delete();

        return redirect()->route('users.show', $post->user_id);
    }
}
