<?php

namespace App\Criteria;

use App\Models\Vendedor;
use Carbon\Carbon;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class VendaRelatorioCriteria.
 *
 * @package namespace App\Criteria;
 */
class VendaRelatorioCriteria implements CriteriaInterface
{
    /**
     * @var Vendedor
     */
    private $vendedor;
    /**
     * @var Carbon
     */
    private $data;

    /**
     * VendaRelatorioCriteria constructor.
     */
    public function __construct(Vendedor $vendedor)
    {

        $this->vendedor = $vendedor;
        $this->data = Carbon::now();
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function apply($model, RepositoryInterface $repository)
    {
       return $model
            ->where('vendedor_id',$this->vendedor->id)
            ->whereRaw("YEAR(data) = {$this->data->year}")
            ->whereRaw("MONTH(data) = {$this->data->month}")
            ->whereRaw("DAY(data) = {$this->data->day}");
    }
}
