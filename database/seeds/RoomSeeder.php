<?php

use Illuminate\Database\Seeder;

use App\Models\Room;
use App\Models\Hostel;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n = 25;
        for ($i=1; $i<=$n; $i++)
        {
            Room::create([
                'number' => $i ,
                'liver_max' => 4,
                'block' => ceil($i/5),
                'area' => 40,
                'hostel_id' => Hostel::all()->first()->id
            ]);
        }
    }
}
