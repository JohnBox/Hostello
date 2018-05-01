<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = ['number', 'floor_id'];
    public $timestamps = false;

    function floor()
    {
        return $this->belongsTo('App\Models\Floor');
    }
}
