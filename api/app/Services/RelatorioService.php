<?php


namespace App\Services;


use App\Criteria\VendaRelatorioCriteria;
use App\Repositories\VendaRepository;
use App\Repositories\VendedorRepository;

class RelatorioService
{
    /**
     * @var VendaRepository
     */
    private $vendaRepository;
    /**
     * @var VendedorRepository
     */
    private $vendedorRepository;

    /**
     * RelatorioService constructor.
     * @param VendaRepository $vendaRepository
     */
    public function __construct(VendaRepository $vendaRepository, VendedorRepository $vendedorRepository)
    {
        $this->vendaRepository = $vendaRepository;
        $this->vendedorRepository = $vendedorRepository;
    }

    public function sendRelatorio(){
        $vendedores = $this->vendedorRepository->skipPresenter()->all();
        if($vendedores->isNotEmpty()){
            $vendedores->each(function($vendedor){
                $this->vendaRepository->pushCriteria(new VendaRelatorioCriteria($vendedor));
                $vendas = $this->vendaRepository->skipPresenter()->all();
                $this->vendaRepository->popCriteria(new VendaRelatorioCriteria($vendedor));
                if($vendas->isNotEmpty()){
                    \App\Jobs\RelatorioVendas::dispatch($vendedor, $vendas);
                }
            });
        }

    }
}
