<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $fillable = [
        'liver_id', 'live_price', 'gas_price', 'elec_price', 'water_price', 'total', 'paid', 'date'
    ];
    public $timestamps = false;

    function liver()
    {
        return $this->belongsTo('App\Models\Liver');
    }
}
