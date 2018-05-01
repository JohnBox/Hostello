<?php

use Illuminate\Database\Seeder;

use App\Models\Pay;
use App\Models\Liver;

class PaySeeder extends Seeder
{
    public function run()
    {
        $livers = Liver::all();
        foreach ($livers as $liver) {
            Pay::create([
                'liver_id' => $liver->id,
                'date' => date('Y-m-d'),
                'live_price' => 100,
                'gas_price' => 50,
                'elec_price' => 50,
                'water_price' => 100,
                'total' => 200,
            ]);
        }
    }
}
