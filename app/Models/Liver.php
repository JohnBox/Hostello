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
    ];
    public $timestamps = false;

    function user()
    {
        return $this->morphOne('App\Models\User', 'profile');
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
        return $this->belongsToMany('App\Models\Payment')->withPivot('live_price', 'paid');
    }

    function violations()
    {
        return $this->belongsToMany('App\Models\Violation')->withPivot('penalty', 'paid');
    }

    function injections()
    {
        return $this->hasMany('App\Models\Injection');
    }

    function ejections()
    {
        return $this->hasMany('App\Models\Ejection');
    }

    function scopeActive($query)
    {
        return $query->where('room_id', '<>', null);
    }

    function scopeNonactive($query)
    {
        return $query->where('room_id', '=', null);
    }

    function full_name()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->second_name;
    }

    function short_full_name()
    {
        return $this->last_name . ' ' . mb_substr($this->first_name, 0, 1) . ' ' . mb_substr($this->second_name, 0, 1);
    }
}
