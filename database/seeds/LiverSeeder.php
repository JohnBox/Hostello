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
        $n = 0;
        $group = Group::all()->first();
        $rooms = Room::all();
        $count = $rooms->count();
        foreach ($rooms as $room) {
            do {
                $hostel = $room->block->floor->hostel;
//                TODO: refactor with eloquent relationship methods
                $phone = '+380991111111';

                $liver = Liver::create([
                    'last_name' => rand(1, $count),
                    'first_name' => rand(1, $count),
                    'second_name' => rand(1, $count),
                    'birth_date' => date('Y-m-d'),
                    'gender' => (bool)rand(0, 1),
                    'is_student' => true,
                    'doc_number' => 'KB1231212',
                    'group_id' => $group->id,
                    'room_id' => $room->id,
                    'phone' => '0991111111',
                    'balance' => 0,
                    'is_active' => true,
                ]);
                $user = User::create([
                    'name' => 'liver' . (($n == 0) ? '' : $n),
                    'email' => 'liver' . (($n == 0) ? '' : $n) . '@gmail.com',
                    'password' => Hash::make('liver')
                ]);
                $liver->user()->save($user);
                $n++;
            } while (0);
        }

    }
}
