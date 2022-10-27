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

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostFormRequest $request)
    {
        //ファイル保存
        $dir = 'posts'; //ディレクトリ名

        $store_file_name = basename($request->file('input_file')->store('public/' . $dir)); //ストレージに保存

        //登録処理
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'file_name' => $request->input_file->getClientOriginalName(),
            'file_path' => 'storage/' . $dir . '/' . $store_file_name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('post.show', $post->id);
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', compact('post'));
    }

    public function update(PostFormRequest $request, $id)
    {
        //ファイルを編集
        $post = Post::where('id', $id)->first(); //編集対象の投稿を取得

        $image = $request->file('input_file'); //リクエストされたファイルを取得

        $update_data = [];

        //ファイルが存在する場合
        if ($image) {
            $dir = 'posts'; //ディレクトリ名

            Storage::disk('public')->delete($post->file_path); //現在の画像を削除

            $store_file_name = basename($image->store('public/' . $dir)); //ストレージに保存

            $update_data['file_name'] = $image->getClientOriginalName();
            $update_data['file_path'] = 'storage/' . $dir . '/' . $store_file_name;
        }

        //更新処理
        $update_data['title'] = $request->title;
        $update_data['content'] = $request->content;
        $post->update($update_data);

        return redirect()->route('post.show', $id);
    }
}
