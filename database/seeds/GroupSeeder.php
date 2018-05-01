<?php

use Illuminate\Database\Seeder;

use App\Models\Group;
use App\Models\Faculty;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculties = Faculty::all();
        foreach ($faculties as $faculty)
        {
            for ($year=1; $year<=$faculty->years; $year++)
            {
                Group::create([
                    'number' => $faculty->short_name . '-1' . $year,
                    'course' => $year,
                    'leader' => 'Скубак',
                    'phone' => '12345',
                    'faculty_id' => $faculty->id
                ]);
            }

        }

    }
}
