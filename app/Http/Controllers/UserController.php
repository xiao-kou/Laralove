<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('id')->get();

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['posts', 'likes' => function ($query) {
            $query->orderByDesc('id')->get();
        }])->find($id);

        //閲覧ユーザーのフォロー数を取得
        $followings_count = User::find($id)->followings()->count();

        //閲覧ユーザーのフォロワー数を取得
        $followers_count = User::find($id)->followers()->count();

        //閲覧ユーザーをフォロー中か判定
        $user_model = new User;
        $is_following = $user_model->isFollowing($id);

        return view('users.show', compact('user', 'followings_count', 'followers_count', 'is_following'));
    }

    public function edit(User $user) {
        //認可
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(UserFormRequest $request, User $user) {
        //認可
        $this->authorize('update', $user);

        //更新処理
        if ($request->has('new_password')){
            $user->update(['password' => Hash::make($request->new_password)]);
        } else {
            $user->update($request->validated());
        }

        return redirect()->route('users.show', $user->id);
    }

    public function showProfileSettingsForm(User $user) {
        //認可
        $this->authorize('update', $user);

        return view('users.profile_settings', compact('user'));
    }

    public function updateProfile(UserFormRequest $request, User $user) {
        //認可
        $this->authorize('update', $user);

        //ファイル取得
        $image = $request->file('input_image');

        //初期化
        $update_data = [];

        //ファイルが存在する場合
        if ($image) {
            //ディレクトリ名
            $dir = 'profiles';

            //以前のプロフィール画像を削除
            if (basename($user->profile_image_path) !== 'default.png') {
                Storage::disk('public')->delete($user->profile_image_path);
            }

            //ストレージに保存
            $store_file_name = basename($image->store('public/' . $dir));

            //データを格納
            $update_data['profile_image_path'] = 'storage/' . $dir . '/' . $store_file_name;
        }

        //更新処理
        $update_data['name'] = $request->name;
        $update_data['introduction'] = $request->introduction;
        $update_data['location'] = $request->location;
        $update_data['sex'] = $request->sex;
        $user->update($update_data);

        return redirect()->route('users.show', $user->id);
    }

    public function follow(Request $request, User $user)
    {
        //フォロー処理
        Auth::user()->follow($request->user_id);

        //フォロワーの数を取得
        $followers_count = $user->getFollowersCount();
        $param = [
            'followers_count' => $followers_count
        ];

        return response()->json($param);
    }

    public function unfollow(Request $request, User $user)
    {
        //アンフォロー処理
        Auth::user()->unfollow($request->user_id);

        //フォロワーの数を取得
        $followers_count = $user->getFollowersCount();
        $param = [
            'followers_count' => $followers_count
        ];

        return response()->json($param);
    }

    public function followers(User $user)
    {
        $followers = $user->followers()->get();
        return view('users.followers', compact('followers'));
    }

    public function followings(User $user)
    {
        $followings = $user->followings()->get();
        return view('users.followings', compact('followings'));
    }
}
