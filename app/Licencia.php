<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    //
    protected $fillable = [
        'name','code','vig','prod','status'
    ];
}
