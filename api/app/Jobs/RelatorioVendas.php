<?php

namespace App\Jobs;

use App\Models\Vendedor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

class RelatorioVendas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Vendedor
     */
    private $vendedor;
    /**
     * @var Collection
     */
    private $vendas;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Vendedor $vendedor, Collection $vendas)
    {
        $this->vendedor = $vendedor;
        $this->vendas = $vendas;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->vendedor,new \App\Notifications\RelatorioVendas($this->vendas));
    }
}
