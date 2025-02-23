<?php

namespace App\Console;

use App\Models\Trip;
use App\Models\Ticket;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $tickets = Ticket::join('trips', 'trips.trip_id', '=', 'tickets.trip_id')
                ->where('trips.departure', '<', now())
                ->get();
            foreach ($tickets as $ticket) {
                $ticket->delete();
            }
            foreach (Trip::where('departure', '<', now())->get() as $trip) {
                $trip->delete();
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
