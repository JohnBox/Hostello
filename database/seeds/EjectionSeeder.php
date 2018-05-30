<?php

use Illuminate\Database\Seeder;

use App\Models\Watchman;
use App\Models\Liver;
use App\Models\Ejection;

class EjectionSeeder extends Seeder
{
    public function run()
    {
        $watchman = Watchman::first();
        foreach (Liver::all() as $liver) {
            $ejection = new Ejection([
                'date' => date('Y-m-d'),
            ]);
            $ejection->hostel()->associate($watchman->hostel);
            $ejection->watchman()->associate($watchman);
            $ejection->liver()->associate($liver);
            $ejection->room()->associate($liver->room);
            $ejection->save();
            $liver->room()->dissociate();
            $liver->save();
        }
    }
}
