<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('id')->get();

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['posts' => function ($query) {
            $query->orderByDesc('id')->get();
        }])->find($id);

        return view('users.show', compact('user'));
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

        return redirect()->route('user.show', $user->id);
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

        return redirect()->route('user.show', $user->id);
    }
}
