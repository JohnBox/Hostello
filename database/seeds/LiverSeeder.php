<?php

use Illuminate\Database\Seeder;

use App\Models\Liver;
use App\Models\Group;
use App\Models\Room;

class LiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = Group::all()->first();
        $rooms = Room::all();
        $count = $rooms->count();
        foreach ($rooms as $room) {
            for ($i=1; $i<=$room->liver_max; $i++) {
                Liver::create([
                    'last_name' => rand(1, $count),
                    'first_name' => rand(1, $count),
                    'parent_name' => rand(1, $count),
                    'birth' => date('Y-m-d'),
                    'sex' => (bool)rand(0, 1),
                    'student' => true,
                    'group_id' => $group->id,
                    'room_id' => $room->id,
                    'balance' => 0,
                    'active' => true,
                    'live_in' => date('Y-m-d')
                ]);
            }
        }

    }
}
