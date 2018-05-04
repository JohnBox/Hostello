<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Hostel;
use App\Models\User;
use App\Models\Watchman;

class WatchmanSeeder extends Seeder
{
    public function run()
    {
        $hostels = Hostel::all();
        foreach ($hostels as $hostel) {
            $phone = '+380634857813';
            $user = User::create([
                'name' => $phone,
                'email' => $phone . '@gmail.com',
                'password' => Hash::make($phone),
            ]);
            Watchman::create([
                'first_name' => 'Lol',
                'last_name' => 'Kek',
                'second_name' => 'Chebyrek',
                'phone' => $phone,
                'hostel_id' => $hostel->id,
                'user_id' => $user->id
            ]);
        }
    }
}
