<?php

use Illuminate\Database\Seeder;

use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run()
    {
        Faculty::create([
            'name' => 'Розробка програмного забезпечення',
            'short_name' => 'РПЗ',
            'years' => 3
        ]);
        Faculty::create([
            'name' => 'Менеджмент',
            'short_name' => 'МНД',
            'years' => 3
        ]);
        Faculty::create([
            'name' => 'Хімічне програмування',
            'short_name' => 'ХІП',
            'years' => 4
        ]);
    }
}
