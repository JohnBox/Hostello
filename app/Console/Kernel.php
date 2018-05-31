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
            $payment = new Payment([
                'date' => date('Y-m-d')
            ]);
            foreach (Hostel::all() as $hostel)
                foreach ($hostel->livers as $liver) {
                    $payment->hostel_id = $hostel->id;
                    $pivot = [
                        'price' => $liver->room->price,
                        'paid' => rand(0,1) > 0.5 ? null : date('Y-m-d')
                    ];
                    $payment->save();
                    $liver->payments()->attach($payment, $pivot);
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
