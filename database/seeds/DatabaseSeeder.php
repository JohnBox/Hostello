<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call(HostelSeeder::class);
         $this->call(FloorSeeder::class);
         $this->call(BlockSeeder::class);
         $this->call(RoomSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(FacultySeeder::class);
         $this->call(GroupSeeder::class);
         $this->call(LiverSeeder::class);
         $this->call(ViolationSeeder::class);
         $this->call(PaySeeder::class);

    }
}
