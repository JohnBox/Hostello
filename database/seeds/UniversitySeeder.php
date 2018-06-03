<?php

use Illuminate\Database\Seeder;

use App\Models\University;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        University::create([
            'name' => 'Державний Університет Телекомунікацій',
            'address' => 'вул. Соломянська 7',
            'phone' => '1234576',
            'merchant_id' => 'DEADBEEF',
            'merchant_password' => 'BEEFDEAD',
        ]);
    }
}
