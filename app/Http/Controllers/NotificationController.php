<?php

namespace App\Http\Controllers;

use App\Consts\NotificationConst;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function getUnreadMessages()
    {
        $unread_messages = Notification::where('receiver_id', Auth::id())
                                            ->where('event_type', NotificationConst::MESSAGE_SEND_ADDED)
                                            ->where('is_read', false)
                                            ->get();

        return response()->json($unread_messages);
    }
}
