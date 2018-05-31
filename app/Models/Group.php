<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'leader', 'phone', 'course_id'];
    public $timestamps = false;

    function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    function livers()
    {
        return $this->hasMany('App\Models\Liver');
    }

    function short_name()
    {
        // TODO: add template for generating group name
        return 'SHORT_NAME';
    }

    static function generateName(Course $course, int $number)
    {
        return $course->specialty->short_name() . '-' . $course->number . $number;
    }
}
