<?php

use Illuminate\Database\Seeder;

use App\Models\University;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run()
    {
        $university = University::first();
        $university->faculties()->saveMany([
            new Faculty(['name' => 'Розробка програмного забезпечення']),
            new Faculty(['name' => 'Менеджмент']),
            new Faculty(['name' => 'Хімічне програмування'])
        ]);
    }
}
