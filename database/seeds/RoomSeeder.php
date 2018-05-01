<?php

use Illuminate\Database\Seeder;

use App\Models\Floor;
use App\Models\Block;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ROOM_COUNT = 5;
        $blocks = Block::all();
        foreach ($blocks as $block) {
            for ($number=1; $number<=$ROOM_COUNT; $number++) {
                Room::create([
                    'number' => $number ,
                    'liver_max' => 4,
                    'area' => 40,
                    'block_id' => $block->id,
                ]);
            }
        }
    }
}
