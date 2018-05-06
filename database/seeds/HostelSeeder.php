<?php

use Illuminate\Database\Seeder;

use App\Models\University;
use App\Models\Hostel;

class HostelSeeder extends Seeder
{
    public function run()
    {
        $university = University::first();
        Hostel::create([
            'name' => 'Гуртожиток 1',
            'address' => 'Соломянська 7',
            'phone' => '12345',
            'area' => 1000,
            'merchant' => $university->merchant
        ]);
    }
}
