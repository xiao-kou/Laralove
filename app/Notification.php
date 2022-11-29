<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receiver_id',
        'sender_id',
        'message',
        'event_type',
        'is_read',
    ];
}
