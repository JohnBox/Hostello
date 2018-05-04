<?php

use Illuminate\Database\Seeder;

use App\Models\Floor;
use App\Models\Block;

const BLOCK_PER_FLOOR = 1;

class BlockSeeder extends Seeder
{
    public function run()
    {
        $floors = Floor::all();
        foreach ($floors as $floor) {
            for ($number=1; $number<=BLOCK_PER_FLOOR; $number++) {
                Block::create([
                    'number' => $number,
                    'floor_id' => $floor->id
                ]);
            }

        }
    }
}
