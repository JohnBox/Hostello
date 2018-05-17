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
        foreach (Room::all() as $room) {
                $liver = $room->livers()->create([
                    'last_name' => 'Last',
                    'first_name' => 'Name',
                    'second_name' => 'Fatherovich',
                    'birth_date' => date('Y-m-d'),
                    'gender' => (bool)rand(0, 1),
                    'doc_number' => 'KB1231212',
                    'phone' => '0991111111',
                ]);
//                $liver->user()->create([
//                    'name' => 'user'  ,
//                    'email' => 'user' . $liver->id . '@gmail.com',
//                    'password' => Hash::make('user'),
//                ]);
        }
    }
}
