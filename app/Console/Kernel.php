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
                $payment = $hostel->payments()->create([
                    'date' => date('Y-m-d'),
                ]);
                foreach ($hostel->livers as $liver) {
                    if ($liver->room) {
                        $pivot = ['price' => $liver->room->price];
                        $liver->payments()->attach($payment, $pivot);
                        $liver->balance -= $pivot['price'];
                        $liver->save();
                    }
                }
            }
        })->hourly();
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
