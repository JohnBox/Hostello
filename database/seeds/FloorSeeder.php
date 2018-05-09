<?php

use Illuminate\Database\Seeder;

use App\Models\Hostel;
use App\Models\Floor;

const FLOOR_COUNT = 5;

class FloorSeeder extends Seeder
{
    public function run()
    {
        foreach (Hostel::all() as $hostel) {
            foreach (range(1, FLOOR_COUNT) as $number) {
                $hostel->floors()->create(['number' => $number]);
            }
        }
    }
}
