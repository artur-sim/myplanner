<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    function hasStatus(){
        return $this->belongsTo('App\Status','status_id','id');
    }
}
