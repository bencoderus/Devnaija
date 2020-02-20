<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class likepost extends Model
{
    //
    function thread()
    {
        return belongsTo('App\Post', 'pid');
    }

    function like()
    {
        return belongsTo('App\Post', 'name', 'user');
    }
}
