<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = ['number', 'hostel_id'];
    public $timestamps = true;

    function hostel()
    {
        return $this->belongsTo('App\Models\Hostel');
    }

    function blocks()
    {
        return $this->hasMany('App\Models\Block');
    }
}
