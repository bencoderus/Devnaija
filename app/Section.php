<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class section extends Model
{
    use SoftDeletes;
    protected $date =['deleted_at'];

    protected $primaryKey="id";
    public $table="sections";
    //
    function forum()
    {
       return $this->hasMany('App\Forum', 'secid');
    }
}
