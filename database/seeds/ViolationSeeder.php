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
            $pivot = ['price' => 100];
            $liver->violations()->attach($violation, $pivot);
            $liver->balance -= $pivot['price'];
            $liver->save();
            $rand_liver = Liver::inRandomOrder()->first();
            $rand_liver->violations()->attach($violation, $pivot);
            $rand_liver->balance -= $pivot['price'];
            $rand_liver->save();
            $violation->save();
        };
    }
}
