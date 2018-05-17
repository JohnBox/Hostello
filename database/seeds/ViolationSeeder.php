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
            $violation = $watchman->violations()->create(['description' => 'KEK', 'date_of_charge' => date('Y-m-d')]);
            $pivot = [
                'penalty' => 100,
                'paid' => (int)rand(0,1) ? null : date('Y-m-d')
            ];
            $liver->violations()->attach($violation, $pivot);
            Liver::inRandomOrder()->first()->violations()->attach($violation, $pivot);
            $violation->save();
        };
    }
}
