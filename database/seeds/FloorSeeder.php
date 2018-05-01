<?php

use Illuminate\Database\Seeder;

use App\Models\Hostel;
use App\Models\Floor;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $FLOOR_COUNT = 10; // love magic
        $hostels = Hostel::all();
        foreach ($hostels as $hostel) {
            for ($number=1; $number<=$FLOOR_COUNT; $number++) {
                Floor::create([
                    'number' => $number,
                    'hostel_id' => $hostel->id
                ]);
            }
        }
    }
}
