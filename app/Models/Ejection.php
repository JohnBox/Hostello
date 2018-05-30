<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejection extends Model
{
    protected $fillable = ['hostel_id', 'watchman_id', 'liver_id', 'room_id', 'date'];
    public $timestamps = true;

    function hostel()
    {
        return $this->belongsTo('App\Models\Hostel');
    }

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
