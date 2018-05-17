<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = ['watchman_id', 'date', 'description', 'penalty', 'is_paid'];
    public $timestamps = false;

    function watchman()
    {
        return $this->belongsTo('App\Models\Watchman');
    }

    function livers()
    {
        return $this->belongsToMany('App\Models\Liver');
    }
}
