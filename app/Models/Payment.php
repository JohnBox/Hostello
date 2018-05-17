<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['room_id', 'date_of_charge'];
    public $timestamps = false;

    function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    function livers()
    {
        return $this->belongsToMany('App\Models\Liver')->withPivot('live_price', 'paid');
    }
}
