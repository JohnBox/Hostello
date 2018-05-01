<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = ['number', 'hostel_id'];
    public $timestamps = false;

    function hostel()
    {
        return $this->belongsTo('App\Models\Hostel');
    }
}
