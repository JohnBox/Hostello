<?php

use Illuminate\Database\Seeder;

use App\Models\Course;
use App\Models\Group;

const GROUP_PER_COURSE = 1;

class GroupSeeder extends Seeder
{
    public function run()
    {
        foreach (Course::all() as $course)
        {
            foreach (range(1, GROUP_PER_COURSE) as $number) {
                $course->groups()->create([
                    'name' => Group::generateName($course, $number),
                    'leader' => 'Скубак',
                    'phone' => '12345',
                ]);
            }
        }
    }
}
