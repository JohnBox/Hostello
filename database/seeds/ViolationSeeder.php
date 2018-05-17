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
            $violation = $watchman->violations()->create([
                'date' => date('Y-m-d'),
                'description' => 'KEK',
                'penalty' => 100
            ]);
            $liver->violations()->attach($violation);
            Liver::inRandomOrder()->first()->violations()->attach($violation);
            $violation->save();
        };
    }
}
