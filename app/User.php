<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
    protected $guarded = ["id"];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function thread()
    {
        return $this->hasMany('App\Thread', 'author', 'name');
    }

    public function like()
    {
        return $this->hasMany('App\Post', 'user', 'name');
    }

    public function message()
    {
        return $this->hasMany('App\Message', 'reciever', 'name');
    }

    public function post()
    {
        return $this->hasMany('App\Post', 'user', 'name');
    }
}
