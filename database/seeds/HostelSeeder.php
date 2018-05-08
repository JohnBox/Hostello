<?php

use Illuminate\Database\Seeder;

use App\Models\University;
use App\Models\Hostel;

class HostelSeeder extends Seeder
{
    public function run()
    {
        $university = University::first();
        $university->hostels()->saveMany([
            new Hostel([
                'name' => 'Гуртожиток #1',
                'address' => 'Соломянська 7',
                'phone' => '12345',
                'area' => 1000,
                'merchant' => $university->merchant
            ]),
            new Hostel([
                'name' => 'Гуртожиток #2',
                'address' => 'Соломянська 4',
                'phone' => '12345',
                'area' => 10000,
                'merchant' => $university->merchant
            ]),
        ]);
    }
}
