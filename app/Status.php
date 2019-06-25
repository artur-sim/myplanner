<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    function statusOfNote(){
        return $this->hasMany('App\Notes');
    }
}
