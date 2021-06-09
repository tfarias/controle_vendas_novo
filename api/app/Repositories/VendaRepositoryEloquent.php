<?php

namespace App\Repositories;

use App\Models\Venda;
use App\Presenters\VendaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VendaRepositoryEloquent extends BaseRepository implements VendaRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Venda::class;
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
        return VendaPresenter::class;
    }

}
