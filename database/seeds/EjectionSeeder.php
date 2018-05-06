<?php

use Illuminate\Database\Seeder;

use App\Models\Watchman;
use App\Models\Room;
use App\Models\Ejection;

class EjectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $watchman = Watchman::first();
        $rooms = Room::all();
        foreach ($rooms as $room) {
            foreach ($room->livers as $liver) {
                Ejection::create([
                    'date' => date('Y-m-d'),
                    'liver_id' => $liver->id,
                    'room_id' => $room->id,
                    'watchman_id' => $watchman->id
                ]);
            }
        }
    }
}
