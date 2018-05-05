<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'years_of_study', 'university_id'];
    public $timestamps = false;

    function university()
    {
        return $this->belongsTo('App\Models\University');
    }

    function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    function short_name()
    {
        return 'SHORT-NAME';
    }

}
