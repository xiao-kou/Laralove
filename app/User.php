<?php

namespace App;

use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'screen_name',
        'profile_image_path',
        'introduction',
        'location',
        'sex',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 認証メールを日本語化
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function followings()
    {
        return $this->belongsToMany('App\User', 'following_users', 'follower_id', 'followed_id');
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'following_users', 'followed_id', 'follower_id');
    }

    public function follow($user_id)
    {
        return $this->followings()->syncWithoutDetaching($user_id);
    }

    public function unfollow($user_id)
    {
        return $this->followings()->detach($user_id);
    }

    public function getFollowersCount()
    {
        return $this->followers()->count();
    }

    public function isFollowing($user_id)
    {
        return Auth::check()
                    ? Auth::user()->followings()->where('users.id', $user_id)->exists()
                    : false;
    }

    public function likes()
    {
        return $this->belongsToMany('App\Post', 'likes', 'user_id', 'post_id');
    }

    public function is_liking($post_id)
    {
        return Auth::check()
                    ? Auth::user()->likes()->where('post_id', $post_id)->exists()
                    : false;
    }

    public function rooms()
    {
        return $this->belongsToMany('App\Room', 'user_room', 'user_id', 'room_id');
    }

    public function getProfileImage($user_id)
    {
        return $this->find($user_id)->profile_image_path;
    }
}
