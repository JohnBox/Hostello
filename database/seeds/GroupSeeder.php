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
            $groups = [];
            foreach (range(1, GROUP_PER_COURSE) as $number) {
                $groups[] = new Group([
                    'name' => Group::generateName($course, $number),
                    'leader' => 'Скубак',
                    'phone' => '12345',
                ]);
            }
            $course->groups()->saveMany($groups);
        }
    }
}
