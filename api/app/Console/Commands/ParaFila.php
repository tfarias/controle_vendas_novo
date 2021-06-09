<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ParaFila extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parar:fila';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Para o daemon de queue';

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
    }
}
