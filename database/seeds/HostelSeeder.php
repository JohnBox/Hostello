<?php

use Illuminate\Database\Seeder;

use App\Models\Hostel;

class HostelSeeder extends Seeder
{
    public function run()
    {
        Hostel::create([
            'name' => 'Гуртожиток 1',
            'address' => 'Соломянська 7',
            'phone' => '12345',
            'area' => 1000
        ]);
    }
}
