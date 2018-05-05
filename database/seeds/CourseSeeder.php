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
        $specialties = Specialty::all();
        foreach ($specialties as $specialty) {
            for ($number = 1; $number <= $specialty->years_of_study; $number++) {
                Course::create([
                    'number' => $number,
                    'specialty_id' => $specialty->id
                ]);
            }
        }
    }
}
