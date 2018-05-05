<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = ['name', 'years_of_study', 'faculty_id'];
    public $timestamps = false;

    function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }

    function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    function short_name()
    {
        return 'ПД';
    }
}
