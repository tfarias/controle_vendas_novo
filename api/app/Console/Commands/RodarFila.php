<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RodarFila extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:fila';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reinicia o queue:work';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Illuminate\Support\Facades\Artisan::call('queue:restart', []);
        \Illuminate\Support\Facades\Artisan::call('queue:work');
    }
}
