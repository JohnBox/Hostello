<?php

use Illuminate\Database\Seeder;

use App\Models\Watchman;
use App\Models\Liver;
use App\Models\Injection;

class InjectionSeeder extends Seeder
{
    public function run()
    {
        $watchman = Watchman::first();
        foreach (Liver::all() as $liver) {
            $injection = new Injection([
                'date' => date('Y-m-d'),
            ]);
//            $watchman->injections()->save($injection);
//            $liver->injections()->save($injection);
//            $liver->room->injections()->save($injection);
            $injection->save();
        }
    }
}
