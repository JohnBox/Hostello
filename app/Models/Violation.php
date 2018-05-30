<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = ['watchman_id', 'description', 'date_of_charge'];
    public $timestamps = true;

    function watchman()
    {
        return $this->belongsTo('App\Models\Watchman');
    }

    function livers()
    {
        return $this->belongsToMany('App\Models\Liver')->withPivot('penalty', 'paid');
    }
}
