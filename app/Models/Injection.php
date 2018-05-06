<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Injection extends Model
{
    protected $fillable = ['date', 'liver_id', 'room_id', 'watchman_id'];
    public $timestamps = false;

    function liver()
    {
        return $this->belongsTo('App\Models\Liver');
    }

    function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    function watchman()
    {
        return $this->belongsTo('App\Models\Watchman');
    }
}
