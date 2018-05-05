<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = ['name', 'address', 'phone'];
    public $timestamps = false;

    function faculties()
    {
        return $this->hasMany('App\Models\Faculty');
    }
}
