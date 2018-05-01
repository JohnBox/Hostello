<?php

use Illuminate\Database\Seeder;

use App\Models\Floor;
use App\Models\Block;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BLOCK_COUNT = 2;
        $floors = Floor::all();
        foreach ($floors as $floor) {
            for ($number=1; $number<=$BLOCK_COUNT; $number++) {
                Block::create([
                    'number' => $number,
                    'floor_id' => $floor->id
                ]);
            }

        }
    }
}
