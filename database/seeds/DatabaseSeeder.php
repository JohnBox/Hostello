<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UniversitySeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(SpecialtySeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(HostelSeeder::class);
        $this->call(FloorSeeder::class);
        $this->call(BlockSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WatchmanSeeder::class);
        $this->call(LiverSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ViolationSeeder::class);
        $this->call(EjectionSeeder::class);
        $this->call(InjectionSeeder::class);
    }
}
