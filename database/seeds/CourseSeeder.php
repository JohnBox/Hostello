<?php

use Illuminate\Database\Seeder;

use App\Models\Specialty;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        foreach (Specialty::all() as $specialty) {
            foreach (range(1, $specialty->years_of_study) as $number) {
                $specialty->courses()->create(['number' => $number]);
            }
        }
    }
}
