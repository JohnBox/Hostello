<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'merchant_id', 'merchant_password'];
    public $timestamps = true;

    function faculties()
    {
        return $this->hasMany('App\Models\Faculty');
    }

    function hostels()
    {
        return $this->hasMany('App\Models\Hostel');
    }
}
