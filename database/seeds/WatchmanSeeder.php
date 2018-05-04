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
        $n = 0;
        $hostels = Hostel::all();
        foreach ($hostels as $hostel) {
            $phone = '+380661111111';

            $watchman = Watchman::create([
                'first_name' => 'Lol',
                'last_name' => 'Kek',
                'second_name' => 'Chebyrek',
                'phone' => $phone,
                'hostel_id' => $hostel->id,
            ]);
            $user = User::create([
                'name' => 'watchman' . (($n == 0) ? '' : $n),
                'email' => 'watchman' . (($n == 0) ? '' : $n) . '@gmail.com',
                'password' => Hash::make('watchman'),
            ]);
            $watchman->user()->save($user);
            $n++;
        }
    }
}
