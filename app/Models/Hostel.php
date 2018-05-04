<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'area'];
    public $timestamps = false;

    function watchmen()
    {
        return $this->hasMany('App\Models\Watchman');
    }

    function livers()
    {
        return $this->hasMany('App\Models\Liver');
    }

    function floors()
    {
        return $this->hasMany('App\Models\Floor');
    }
}
