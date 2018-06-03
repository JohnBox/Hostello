<?php

namespace App\Console;

use App\Models\Hostel;
use App\Models\Liver;
use App\Models\Payment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            foreach (Hostel::all() as $hostel) {
                $payment = new Payment([
                    'date' => date('Y-m-d'),
                    'hostel_id' => $hostel->id,
                ]);
                foreach ($hostel->livers as $liver) {
                    $pivot = ['price' => $liver->room->price];
                    $payment->livers()->attach($liver, $pivot);
                    $payment->save();
                    $liver->payments()->attach($payment, $pivot);
                    $liver->balance -= $pivot['price'];
                    $liver->save();
                }
            }
        })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
