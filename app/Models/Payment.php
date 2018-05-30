<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['hostel_id', 'room_id', 'date_of_charge'];
    public $timestamps = true;

    function hostel()
    {
        return $this->belongsTo('App\Models\Hostel');
    }

    function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    function livers()
    {
        return $this->belongsToMany('App\Models\Liver')->withPivot('live_price', 'paid');
    }
}
