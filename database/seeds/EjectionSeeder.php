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
//            $watchman->enjections()->save($ejection);
            $liver->enjections()->save($ejection);
            $liver->room->enjections()->save($ejection);
            $ejection->save();
        }
    }
}
