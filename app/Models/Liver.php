<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liver extends Model
{
    protected $fillable = [
        'last_name', 'first_name', 'second_name',
        'birth_date', 'gender', 'student', 'phone',
        'balance', 'injected', 'ejected',
        'room_id',
        'group_id',
        'user_id'
    ];
    public $timestamps = false;

    function user()
    {
        return $this->belongsTo('App\Models\User');
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

}
