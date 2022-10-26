<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;

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
}
