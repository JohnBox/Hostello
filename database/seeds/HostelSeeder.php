<?php

use Illuminate\Database\Seeder;

use App\Models\Hostel;

class HostelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hostel::create([
            'name' => 'Гуртожиток 1',
            'address' => 'Соломянська 7',
            'phone' => '12345',
            'area' => 1000
        ]);
//        Hostel::create([
//            'name' => 'Гуртожиток 2',
//            'address' => 'Кавказька 13',
//            'phone' => '54321',
//            'area' => 500
//        ]);
    }
}
