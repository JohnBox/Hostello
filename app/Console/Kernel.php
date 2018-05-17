<?php

namespace App\Console;

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
                'date_of_charge' => date('Y-m-d')
            ]);
            foreach (Liver::all() as $liver) {
                $payment->fill(['room_id' => $liver->room->id]);
                $pivot = [
                    'live_price' => 100,
                    'paid' => (int)rand(0,1) ? null : date('Y-m-d')
                ];
                $payment->save();
                $liver->payments()->attach($payment, $pivot);
            }
        })->monthlyOn(1);
        Log::debug('DONE');
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
