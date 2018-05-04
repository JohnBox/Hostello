<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['number', 'liver_max', 'area', 'block_id'];
    public $timestamps = false;

    function block()
    {
        return $this->belongsTo('App\Models\Block');
    }

    function livers()
    {
        return $this->hasMany('App\Models\Liver');
    }
}
