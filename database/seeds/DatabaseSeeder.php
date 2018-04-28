<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(HostelSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(RoomSeeder::class);
         $this->call(FacultySeeder::class);
         $this->call(GroupSeeder::class);
         $this->call(LiverSeeder::class);
         $this->call(ViolationSeeder::class);
         $this->call(PaySeeder::class);

    }
}
