<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show($id)
    {
        $user = User::with('posts:id,user_id,file_path')->find($id);
        return view('users.show', compact('user'));
    }
}
