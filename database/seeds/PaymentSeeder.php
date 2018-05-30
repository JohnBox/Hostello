<?php

use Illuminate\Database\Seeder;

use App\Models\Watchman;
use App\Models\Liver;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $payment = new Payment([
            'date_of_charge' => date('Y-m-d'),
        ]);
        foreach (Liver::all() as $liver) {
            $payment->fill(['room_id' => $liver->room->id, 'hostel_id' => $liver->hostel->id]);
            $pivot = [
                'live_price' => 100,
                'paid' => (int)rand(0,1) ? null : date('Y-m-d')
            ];
            $payment->save();
            $liver->payments()->attach($payment, $pivot);
        }
    }
}
