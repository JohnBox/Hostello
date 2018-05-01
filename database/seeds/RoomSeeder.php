<?php

use Illuminate\Database\Seeder;

use App\Models\Floor;
use App\Models\Room;

const ROOM_PER_BLOCK = 5;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $floors = Floor::all();
        foreach ($floors as $floor) {
            foreach ($floor->blocks as $block) {
                for ($number = ROOM_PER_BLOCK * ($block->number-1) + 1; $number <= ROOM_PER_BLOCK * $block->number; $number++) {
                    Room::create([
                        'number' => sprintf('%d0%d', $floor->id, $number),
                        'liver_max' => 4,
                        'area' => 40,
                        'block_id' => $block->id,
                    ]);
                }
            }
        }
    }
}
