<?php

namespace App\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class VendedorCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class VendedorCriteria implements CriteriaInterface
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
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     *  @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $filtro = $model->orderBy('nome', 'ASC');
        if (!empty($this->parans["id"])) {
            $filtro->where("id", $this->parans["id"]);
        }
        if (!empty($this->parans["nome"])) {
            $filtro->where("nome", 'like', '%' . $this->parans["nome"] . '%');
        }
        if (!empty($this->parans["email"])) {
            $filtro->where("email", 'like', '%' . $this->parans["email"] . '%');
        }

        return $filtro;
    }
}
