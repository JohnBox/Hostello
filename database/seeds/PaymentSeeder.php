<?php

use Illuminate\Database\Seeder;

use App\Models\Watchman;
use App\Models\Liver;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $watchman = Watchman::first();
        foreach (Liver::all() as $liver) {
            $payment = new Payment([
                'date' => date('Y-m-d'),
                'live_price' => 100,
                'g_price' => 50,
                'e_price' => 50,
                'w_price' => 100,
            ]);
            $liver->payments()->save($payment);
            $liver->room->payments()->save($payment);
//            $watchman->payments()->save($payment);
            $payment->save();
        }
    }
}
