<?php

use Illuminate\Database\Seeder;

use App\Models\Floor;
use App\Models\Block;

const BLOCK_PER_FLOOR = 2;

class BlockSeeder extends Seeder
{
    public function run()
    {
        foreach (Floor::all() as $floor) {
            foreach (range(1, BLOCK_PER_FLOOR) as $number) {
                $floor->blocks()->create(['number' => $number]);
            }
        }
    }
}
