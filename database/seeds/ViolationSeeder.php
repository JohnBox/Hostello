<?php

use Illuminate\Database\Seeder;

use App\Models\Watchman;
use App\Models\Liver;
use App\Models\Violation;

class ViolationSeeder extends Seeder
{
    public function run()
    {
        $watchman = Watchman::first();
        foreach (Liver::all() as $liver) {
            $violation = new Violation([
                'date' => date('Y-m-d'),
                'description' => 'lol kek check',
                'penalty' => 100,
            ]);
            $liver->violations()->save($violation);
//            $watchman->violations()->save($violation);
            $liver->room->violations()->save($violation);
            $violation->save();
        }
    }
}
