<?php

use App\Models\Room;
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
            $room = Room::inRandomOrder()->first();
            $injection = new Injection([
                'date' => date('Y-m-d'),
            ]);
            $injection->hostel()->associate($watchman->hostel);
            $injection->watchman()->associate($watchman);
            $injection->liver()->associate($liver);
            $injection->room()->associate($room);
            $injection->save();
            $liver->room()->associate($room);
            $liver->save();
        }
    }
}
