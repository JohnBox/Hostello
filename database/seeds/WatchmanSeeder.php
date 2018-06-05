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
        foreach (Hostel::all() as $i => $hostel) {
            $watchman = $hostel->watchmen()->create([
                'first_name' => 'Lol',
                'last_name' => 'Kek',
                'second_name' => 'Chebyrek',
                'phone' => '+380661111111',
            ]);
            $watchman->user()->create([
                'name' => 'watchman'.($i+1),
                'email' => 'watchman',
                'password' => Hash::make('watchman'.($i+1)),
            ]);
        }
    }
}
