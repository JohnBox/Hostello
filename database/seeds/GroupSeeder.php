<?php

use Illuminate\Database\Seeder;

use App\Models\Course;
use App\Models\Group;

const GROUP_PER_COURSE = 1;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $courses = Course::all();
        foreach ($courses as $course)
        {
            for ($year=1; $year <= $course->faculty->years_of_study; $year++)
            {
                Group::create([
                    'name' => $course->faculty->short_name . '-' . $course->number . '1',
                    'leader' => 'Скубак',
                    'phone' => '12345',
                    'course_id' => $course->id,
                ]);
            }

        }

    }
}
