<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['number', 'course', 'leader', 'phone', 'faculty_id'];
    public $timestamps = false;

    function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }

    function livers()
    {
        return $this->hasMany('App\Models\Liver');
    }
}
