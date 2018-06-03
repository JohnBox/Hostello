<?php

use Illuminate\Database\Seeder;

use App\Models\University;
use App\Models\Hostel;

class HostelSeeder extends Seeder
{
    public function run()
    {
        $university = University::first();
        $university->hostels()->createMany([
            [
                'name' => 'Гуртожиток #1',
                'address' => 'Соломянська 7',
                'phone' => '12345',
                'merchant_id' => $university->merchant_id,
                'merchant_password' => $university->merchant_password,
            ],
            [
                'name' => 'Гуртожиток #2',
                'address' => 'Соломянська 4',
                'phone' => '12345',
                'merchant_id' => $university->merchant_id,
                'merchant_password' => $university->merchant_password,
            ]
        ]);
    }
}
