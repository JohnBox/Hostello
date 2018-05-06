<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liver extends Model
{
    protected $fillable = [
        'last_name', 'first_name', 'second_name',
        'birth_date', 'gender', 'student', 'doc_number', 'phone',
        'balance', 'injected', 'ejected',
        'room_id',
        'group_id',
        'hostel_id',
    ];
    public $timestamps = false;

    function user()
    {
        return $this->morphOne('App\Models\User', 'profile');
    }

    function hostel()
    {
        return $this->belongsTo('App\Models\Hostel');
    }

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

    function full_name()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->second_name;
    }
}
