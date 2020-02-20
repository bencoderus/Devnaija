<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    function thread()
    {
        return $this->belongsTo('App\Thread', 'threadid');
    }

    function user()
    {
        return $this->belongsTo('App\User', 'threadid');
    }

}
