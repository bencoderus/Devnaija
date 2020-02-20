<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class forum extends Model
{
    use SoftDeletes;
protected $date =['deleted_at'];

    protected $primaryKey="id";
    public $table="forums";
    //
    function section()
    {
       return $this->belongsTo('App\Section', 'secid');
    }
    function thread()
    {
        return $this->hasMany('App\Thread', 'forumid');
    }
}
