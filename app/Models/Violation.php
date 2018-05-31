<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = ['hostel_id', 'watchman_id', 'description', 'date'];
    public $timestamps = true;

    function hostel()
    {
        return $this->belongsTo('App\Models\Hostel');
    }

    function watchman()
    {
        return $this->belongsTo('App\Models\Watchman');
    }

    function livers()
    {
        return $this->belongsToMany('App\Models\Liver')->withPivot('price', 'paid');
    }
}
