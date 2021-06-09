<?php

namespace App\Console;

use App\Console\Commands\ParaFila;
use App\Console\Commands\RelatorioDiario;
use App\Console\Commands\RodarFila;
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
        RelatorioDiario::class,
        RodarFila::class,
        ParaFila::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:relatorio')->dailyAt('18:00');
        $schedule->command('run:fila')->dailyAt('18:10');
        $schedule->command('parar:fila')->dailyAt('00:00');
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
