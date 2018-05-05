<?php

use Illuminate\Database\Seeder;

use App\Models\Faculty;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
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
            Specialty::create([
                'name' => 'special',
                'years_of_study' => 4,
                'faculty_id' => $faculty->id
            ]);
        }
    }
}
