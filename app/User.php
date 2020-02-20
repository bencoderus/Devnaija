<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $date = ['deleted_at', 'last_seen'];
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function thread()
    {
        return $this->hasMany('App\Thread', 'author', 'name');
    }

    function like()
    {
        return $this->hasMany('App\Post', 'user', 'name');
    }

    function message()
    {
        return $this->hasMany('App\Message', 'reciever', 'name');
    }

    function post()
    {
        return $this->hasMany('App\Post', 'user', 'name');
    }
}
