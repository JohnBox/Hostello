<?php

use Illuminate\Database\Seeder;

use App\Models\Watchman;
use App\Models\Liver;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        foreach (Liver::all() as $liver) {
            $payment = $liver->room->payments()->create([
                'date' => date('Y-m-d'),
                'live_price' => $liver->room->live_price
            ]);
            $liver->payments()->attach($payment);
            $payment->save();
        }
    }
}
