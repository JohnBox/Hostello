<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Injection extends Model
{
    protected $fillable = ['watchman_id', 'liver_id', 'room_id', 'date'];
    public $timestamps = true;

    function watchman()
    {
        return $this->belongsTo('App\Models\Watchman');
    }

    function liver()
    {
        return $this->belongsTo('App\Models\Liver');
    }

    function room()
    {
        return $this->belongsTo('App\Models\Room');
    }
}
