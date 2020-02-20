<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $date =['deleted_at'];
    //thread

    function thread()
    {
        return $this->belongsTo('App\Thread', 'threadid');
    }

    function like()
    {
        return $this->hasMany('App\Likepost', 'pid');
    }

    function user()
    {
        return $this->belongsTo('App\User', 'user');
    }
}
