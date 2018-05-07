<?php

use Illuminate\Database\Seeder;

use App\Models\Specialty;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Specialty::all() as $specialty) {
            $courses = [];
            foreach (range(1, $specialty->years_of_study) as $number) {
                $courses[] = new Course(['number' => $number]);
            }
            $specialty->courses()->saveMany($courses);
        }
    }
}
