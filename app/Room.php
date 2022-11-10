<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
    ];

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function participants()
    {
        return $this->belongsToMany('App\User', 'user_room', 'room_id', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'messages', 'room_id', 'user_id')
                    ->withPivot(['text', 'file_path'])
                    ->withTimestamps();
    }

    public function getLatestMessages()
    {
        return $this->users()->orderBy('messages.created_at', 'DESC')
                    ->take(50)
                    ->get()
                    ->sortBy('pivot.created_at');
    }
}
