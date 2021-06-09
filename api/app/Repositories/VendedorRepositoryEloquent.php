<?php

namespace App\Repositories;

use App\Models\Vendedor;
use App\Presenters\VendedorPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VendedorRepositoryEloquent extends BaseRepository implements VendedorRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vendedor::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function presenter()
    {
        return VendedorPresenter::class;
    }

}
