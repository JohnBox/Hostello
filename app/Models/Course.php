<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['number', 'faculty_id'];
    public $timestamps = false;

    function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }

    function groups()
    {
        return $this->hasMany('App\Models\Group');
    }
}
