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
        $user = User::with(['posts' => function ($query) {
            $query->orderByDesc('id')->get();
        }])->find($id);
        return view('users.show', compact('user'));
    }
}
