<?php

use Illuminate\Database\Seeder;

use App\Models\Violation;
use App\Models\Liver;

class ViolationSeeder extends Seeder
{
    public function run()
    {
        $livers = Liver::all();
        foreach ($livers as $liver) {
            Violation::create([
                'liver_id' => $liver->id,
                'description' => 'lol kek check',
                'penalty' => 100,
                'date' => date('Y-m-d'),
                'paid' => false
            ]);
        }
    }
}
