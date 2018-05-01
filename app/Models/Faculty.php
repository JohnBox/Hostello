<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'short_name', 'years'];
    public $timestamps = false;

    function groups()
    {
        return $this->hasMany('App\Models\Group');
    }
}
