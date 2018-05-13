<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['number', 'liver_max', 'area', 'live_price', 'live_price_summer', 'block_id'];
    public $timestamps = false;

    function block()
    {
        return $this->belongsTo('App\Models\Block');
    }

    function livers()
    {
        return $this->hasMany('App\Models\Liver');
    }

    function payments()
    {
        return $this->hasMany('App\Models\Payment');
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
