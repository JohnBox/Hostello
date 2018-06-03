<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'university_id'];
    public $timestamps = true;

    function university()
    {
        return $this->belongsTo('App\Models\University');
    }

    function specialties()
    {
        return $this->hasMany('App\Models\Specialty');
    }

    function short_name()
    {
        return implode('', array_map(function ($x) { return mb_substr(mb_strtoupper($x), 0, 1); }, explode(' ', $this->name)));
    }
}
