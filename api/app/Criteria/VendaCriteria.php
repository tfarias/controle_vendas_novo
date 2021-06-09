<?php

namespace App\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class VendaCriteria.
 *
 * @package namespace App\Criteria;
 */
class VendaCriteria implements CriteriaInterface
{
    /**
     * @var Request
     */
    private $parans;

    /**
     * FuncionarioCriteria constructor.
     */
    public function __construct($parans)
    {
        $this->parans = $parans;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $filtro = $model->orderBy('id', 'DESC');
        if (!empty($this->parans["id"])) {
            $filtro->where("id", $this->parans["id"]);
        }

        if (!empty($this->parans["vendedor_id"])) {
            $filtro->where("vendedor_id", $this->parans["vendedor_id"]);
        }

        return $filtro;
    }
}
