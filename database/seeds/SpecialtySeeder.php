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
        foreach (Faculty::all() as $faculty) {
            $faculty->specialties()->saveMany([
                new Specialty(['name' => $faculty->short_name() . ' Спецільність 1', 'years_of_study' => 4]),
                new Specialty(['name' => $faculty->short_name() . ' Спецільність 2', 'years_of_study' => 3])
            ]);
        }
    }
}
