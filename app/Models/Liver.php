<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liver extends Model
{
    protected $fillable = [
        'last_name', 'first_name', 'second_name',
        'birth_date',
        'gender',
        'doc_number',
        'phone',
        'balance',
        'bad_habit',
        'room_id',
        'group_id',
        'hostel_id',
    ];
    public $timestamps = true;

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

    function payments()
    {
        return $this->belongsToMany('App\Models\Payment')->withPivot('price', 'paid');
    }

    function violations()
    {
        return $this->belongsToMany('App\Models\Violation')->withPivot('price', 'paid');
    }

    function injections()
    {
        return $this->hasMany('App\Models\Injection');
    }

    function ejections()
    {
        return $this->hasMany('App\Models\Ejection');
    }

    function scopeActive($query, Hostel $hostel)
    {
        return $query->where('room_id', '<>', null)->where('hostel_id', '=', $hostel->id);
    }

    function scopeNonactive($query, Hostel $hostel)
    {
        return $query->where('room_id', '=', null)->where('hostel_id', '=', $hostel->id);
    }

    function scopeOwer($query, Hostel $hostel)
    {
        return $this->where('hostel_id', '=', $hostel->id)->where('balance', '<', 0);
    }

    function scopeAny($query, Hostel $hostel)
    {
        return $query->where('hostel_id', '=', $hostel->id);
    }

    function full_name()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->second_name;
    }

    function short_name()
    {
        return $this->last_name.' '.mb_substr($this->first_name, 0, 1).'. '.mb_substr($this->second_name, 0, 1).'.';
    }
}
