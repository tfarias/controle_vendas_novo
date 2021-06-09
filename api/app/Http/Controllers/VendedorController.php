<?php

namespace App\Http\Controllers;

use App\Criteria\VendedorCriteria;
use App\Http\Requests\VendedorRequest;
use App\Models\Vendedor;
use App\Repositories\VendedorRepository;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    /**
     * @var VendedorRepository
     */
    private $repository;

    /**
     * VendedorController constructor.
     */
    public function __construct(VendedorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request){
        $this->repository->pushCriteria(new VendedorCriteria($request->all()));
        return $this->repository->paginate(10);
    }

    public function store(VendedorRequest $request){
        return $this->repository->create($request->all());
    }

    public function update(VendedorRequest $request, Vendedor $vendedor){
        return $this->repository->update($request->all(),$vendedor->id);
    }

    public function lista(Request $request){
        $this->repository->pushCriteria(new VendedorCriteria($request->all()));
        return $this->repository->all();
    }
}
