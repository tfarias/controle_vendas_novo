<?php

namespace App\Console\Commands;

use App\Services\RelatorioService;
use Illuminate\Console\Command;

class RelatorioDiario extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:relatorio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var RelatorioService
     */
    private $relatorioService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RelatorioService $relatorioService)
    {
        parent::__construct();
        $this->relatorioService = $relatorioService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $this->relatorioService->sendRelatorio();
    }
}
