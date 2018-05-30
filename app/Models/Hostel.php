<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'area', 'merchant', 'university_id'];
    public $timestamps = false;

    function watchmen()
    {
        return $this->hasMany('App\Models\Watchman');
    }

    function floors()
    {
        return $this->hasMany('App\Models\Floor');
    }

    function livers()
    {
        return $this->hasMany('App\Models\Liver');
    }

    function violations()
    {
        return $this->hasMany('App\Models\Violation');
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
