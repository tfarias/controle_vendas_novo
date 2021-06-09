<?php

namespace App\Http\Controllers;

use App\Criteria\VendaCriteria;
use App\Http\Requests\VendaRequest;
use App\Models\Vendedor;
use App\Repositories\VendaRepository;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    /**
     * @var VendaRepository
     */
    private $repository;

    /**
     * VendaController constructor.
     * @param VendaRepository $repository
     */
    public function __construct(VendaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request){
        $this->repository->pushCriteria(new VendaCriteria($request->all()));
        return $this->repository->paginate(10);
    }

    /**
     * @param VendaRequest $request
     * @return mixed
     */
    public function store(VendaRequest $request){
       return $this->repository->create($request->all());
    }

    /**
     * @param Request $request
     * @param Vendedor $vendedor
     * @return mixed
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function lista(Request $request, Vendedor $vendedor){
        $this->repository->pushCriteria(new VendaCriteria(['vendedor_id'=> $vendedor->id]));
        return $this->repository->paginate(10);
    }


}
