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

    function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    function violations()
    {
        return $this->hasMany('App\Models\Violation');
    }

    function injections()
    {
        return $this->hasMany('App\Models\Injection');
    }

    function ejections()
    {
        return $this->hasMany('App\Models\Ejection');
    }

    function full_name()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->second_name;
    }

    function short_full_name()
    {
        return $this->last_name . ' ' . mb_substr($this->first_name, 0, 1) . ' ' . mb_substr($this->second_name, 0, 1);
    }
}
