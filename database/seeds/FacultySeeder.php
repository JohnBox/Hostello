<?php

use Illuminate\Database\Seeder;

use App\Models\University;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run()
    {
        $university = University::first();
        $university->faculties()->createMany([
            ['name' => 'Розробка програмного забезпечення'],
            ['name' => 'Менеджмент'],
            ['name' => 'Хімічне програмування']
        ]);
    }
}
