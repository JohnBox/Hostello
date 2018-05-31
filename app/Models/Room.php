<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['number', 'liver_max', 'price', 'price_summer', 'block_id', 'hostel_id'];
    public $timestamps = false;

    function hostel()
    {
        return $this->belongsTo('App\Models\Hostel');
    }

    function block()
    {
        return $this->belongsTo('App\Models\Block');
    }

    function livers()
    {
        return $this->hasMany('App\Models\Liver');
    }

    function injections()
    {
        return $this->hasMany('App\Models\Injection');
    }

    function ejections()
    {
        return $this->hasMany('App\Models\Ejection');
    }
}
