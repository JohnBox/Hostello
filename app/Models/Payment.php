<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['watchman_id', 'liver_id', 'room_id', 'date',
        'live_price', 'is_paid'];
    public $timestamps = false;

    function liver()
    {
        return $this->belongsTo('App\Models\Liver');
    }

    function watchman()
    {
        return $this->belongsTo('App\Models\Watchman');
    }

    function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    function total()
    {
        return $this->live_price + $this->g_price + $this->e_price + $this->w_price;
    }
}
