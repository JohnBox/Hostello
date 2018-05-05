<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'short_name', 'university_id'];
    public $timestamps = false;

    function university()
    {
        return $this->belongsTo('App\Models\University');
    }

    function specialties()
    {
        return $this->hasMany('App\Models\Specialty');
    }
}
