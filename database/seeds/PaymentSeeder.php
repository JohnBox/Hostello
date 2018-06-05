<?php

use App\Models\Hostel;
use Illuminate\Database\Seeder;

use App\Models\Watchman;
use App\Models\Liver;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run()
    {

        foreach (Hostel::all() as $hostel) {
            $payment = $hostel->payments()->create([
                'date' => date('Y-m-d'),
            ]);
            foreach ($hostel->livers as $liver) {
                $pivot = ['price' => $liver->room->price];
                $liver->payments()->attach($payment, $pivot);
                $liver->balance -= $pivot['price'];
                $liver->save();
            }
        }
    }
}
