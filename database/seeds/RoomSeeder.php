<?php

use Illuminate\Database\Seeder;

use App\Models\Floor;
use App\Models\Room;

const ROOM_PER_BLOCK = 5;

class RoomSeeder extends Seeder
{
    public function run()
    {
        foreach (Floor::all() as $floor) {
            foreach ($floor->blocks as $block) {
                for ($number = ROOM_PER_BLOCK * ($block->number-1) + 1; $number <= ROOM_PER_BLOCK * $block->number; $number++) {
                    $block->rooms()->create([
                        'number' => $floor->id * 100 + $number,
                        'liver_max' => 4,
                        'live_price' => 100,
                        'live_price_summer' => 200,
                    ]);
                }
            }
        }
    }
}
