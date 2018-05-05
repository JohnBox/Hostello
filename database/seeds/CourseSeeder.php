<?php

use Illuminate\Database\Seeder;

use App\Models\Faculty;
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
        $faculties = Faculty::all();
        foreach ($faculties as $faculty) {
            for ($number = 1; $number <= $faculty->years_of_study; $number++) {
                Course::create([
                    'number' => $number,
                    'faculty_id' => $faculty->id
                ]);
            }
        }
    }
}
