<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Liver;
use App\Models\Group;
use App\Models\Room;

class LiverSeeder extends Seeder
{
    public function run()
    {
        $group = Group::all()->first();
        $rooms = Room::all();
        $count = $rooms->count();
        foreach ($rooms as $room) {
            for ($i=1; $i<=$room->liver_max; $i++) {
//                TODO: refactor with eloquent relationship methods
                $phone = $room->id . '2345' . $i;
                $user = User::create([
                    'name' => $phone,
                    'email' => $phone . '@gmail.com',
                    'password' => Hash::make($phone)
                ]);
                Liver::create([
                    'last_name' => rand(1, $count),
                    'first_name' => rand(1, $count),
                    'second_name' => rand(1, $count),
                    'birth_date' => date('Y-m-d'),
                    'gender' => (bool)rand(0, 1),
                    'student' => true,
                    'group_id' => $group->id,
                    'room_id' => $room->id,
                    'balance' => 0,
                    'injected' => date('Y-m-d'),
                    'user_id' => $user->id
                ]);
            }
        }

    }
}
