<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watchman extends Model
{
    protected $fillable = ['first_name', 'last_name', 'second_name', 'phone', 'hostel_id'];
    public $timestamps = false;

    function hostel()
    {
        return $this->belongsTo('App\Models\Hostel');
    }

    function user()
    {
        return $this->morphOne('App\Models\User', 'profile');
    }
}
