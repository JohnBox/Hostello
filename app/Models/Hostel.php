<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'area'];
    public $timestamps = false;

    function users()
    {
        return $this->hasMany('App\Models\User');
    }

    function floors()
    {
        return $this->hasMany('App\Models\Floor');
    }
}
