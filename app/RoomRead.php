<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomRead extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'read',
    ];
}
