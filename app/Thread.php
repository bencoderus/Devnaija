<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
use SoftDeletes;
protected $date =['deleted_at'];
//
function forum()
{
return $this->belongsTo('App\Forum', 'forumid');
}

function user()
{
return $this->belongsTo('App\User', 'name', 'author');
}


function post()
{
return $this->hasMany('App\Post', 'threadid');
}

function like()
{
return $this->hasMany('App\Likepost', 'pid');
}
}
