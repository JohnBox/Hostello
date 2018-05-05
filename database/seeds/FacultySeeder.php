<?php

use Illuminate\Database\Seeder;

use App\Models\University;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run()
    {
        $university = University::first();
        Faculty::create([
            'name' => 'Розробка програмного забезпечення',
            'short_name' => 'РПЗ',
            'university_id' => $university->id
        ]);
        Faculty::create([
            'name' => 'Менеджмент',
            'short_name' => 'МНД',
            'university_id' => $university->id
        ]);
        Faculty::create([
            'name' => 'Хімічне програмування',
            'short_name' => 'ХІП',
            'university_id' => $university->id
        ]);
    }
}
