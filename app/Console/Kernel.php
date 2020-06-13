<?php

namespace App\Console;

use App\Support\Scheduler;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */

    protected $scheduler;

    /**
     * Kernel constructor.
     * @param Application $app
     * @param Dispatcher $events
     * @param Scheduler $scheduler
     */
    function __construct(Application $app, Dispatcher $events, Scheduler $scheduler)
    {
        parent::__construct($app, $events);

        $this->scheduler = $scheduler;

    }

    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

//        $schedule->call(function () {
//            $this->scheduler->sendEmail();
//        })
////            ->everyMinute();
//            ->dailyAt('08:00');
//
//        $schedule->call(function () {
//            $this->scheduler->sendEmail();
//        })
//            ->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
