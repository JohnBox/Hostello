<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['hostel_id', 'date'];
    public $timestamps = true;

    function hostel()
    {
        return $this->belongsTo('App\Models\Hostel');
    }

    function livers()
    {
        return $this->belongsToMany('App\Models\Liver')->withPivot('price', 'paid');
    }
}
