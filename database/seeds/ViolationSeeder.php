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
                'description' => 'KEK',
                'date' => date('Y-m-d'),
                'hostel_id' => $watchman->hostel->id
            ]);
            $pivot = [
                'price' => 100,
                'paid' => rand(0,1) > 0.5 ? null : date('Y-m-d')
            ];
            $liver->violations()->attach($violation, $pivot);
            Liver::inRandomOrder()->first()->violations()->attach($violation, $pivot);
            $violation->save();
        };
    }
}
