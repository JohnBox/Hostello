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
        foreach (Hostel::all() as $hostel) {
            $phone = '+380661111111';
            $watchman = new Watchman([
                'first_name' => 'Lol',
                'last_name' => 'Kek',
                'second_name' => 'Chebyrek',
                'phone' => $phone,
            ]);
            $hostel->watchmen()->save($watchman);
            $user = User::create([
                'name' => 'watchman'  ,
                'email' => 'watchman' . $watchman->id . '@gmail.com',
                'password' => Hash::make('watchman'),
            ]);
            $watchman->user()->save($user);
        }
    }
}
