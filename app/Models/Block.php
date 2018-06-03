<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['number', 'floor_id'];
    public $timestamps = true;

    function floor()
    {
        return $this->belongsTo('App\Models\Floor');
    }

    function rooms()
    {
        return$this->hasMany('App\Models\Room');
    }
}
