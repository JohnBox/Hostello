<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['number', 'specialty_id'];
    public $timestamps = false;

    function specialty()
    {
        return $this->belongsTo('App\Models\Specialty');
    }

    function groups()
    {
        return $this->hasMany('App\Models\Group');
    }
}
