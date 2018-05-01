<?php

use Illuminate\Database\Seeder;

use App\Models\Hostel;
use App\Models\Floor;

const FLOOR_COUNT = 10;

class FloorSeeder extends Seeder
{
    public function run()
    {
        $hostels = Hostel::all();
        foreach ($hostels as $hostel) {
            for ($number=1; $number<=FLOOR_COUNT; $number++) {
                Floor::create([
                    'number' => $number,
                    'hostel_id' => $hostel->id
                ]);
            }
        }
    }
}
