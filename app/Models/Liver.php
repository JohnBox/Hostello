<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liver extends Model
{
    protected $fillable = [
        'last_name', 'first_name', 'parent_name',
        'birth', 'sex',
        'student', 'group_id',
        'country', 'canton', 'city', 'street', 'house', 'apart',
        'series', 'number', 'which', 'when',
        'tel1', 'tel2', 'tel3',
        'room_id', 'balance',
        'active',
        'live_in', 'live_out'
    ];
    public $timestamps = false;

    function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    function violations()
    {
        return $this->hasMany('App\Models\Violation');
    }

    function pays()
    {
        return $this->hasMany('App\Models\Pay');
    }

    function scopeActive($query)
    {
        return $query->where('active','=',true)->get();
    }

    function scopeNonactive($query)
    {
        return $query->where('active','=',null)->get();
    }

    function scopeRemoved($query)
    {
        return $query->where('active','=',false)->get();
    }

}
