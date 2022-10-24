<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show($sender_id, $recipient_id)
    {
        return view('messages.show');
    }
}
