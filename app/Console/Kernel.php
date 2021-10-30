<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SendMessage;
use App\Console\Commands\SendMessageGive;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendMessage::class,
        SendMessageGive::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        /*$schedule->call('App\Http\Controllers\SmsController@get')->dailyAt('09:00');
        $schedule->call('App\Http\Controllers\SmsController@give')->dailyAt('18:00');*/
        //$schedule->call('App\Http\Controllers\SmsController@give')->everyMinute();
        $schedule->command('send:message')->everyMinute();
        $schedule->command('send:messagegive')->everyMinute();
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
