<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Vendedor;

/**
 * Class VendaTransformer.
 *
 * @package namespace App\Transformers;
 */
class VendedorTransformer extends TransformerAbstract
{
    /**
     * Transform the Venda entity.
     *
     * @param \App\Models\Venda $model
     *
     * @return array
     */
    public function transform(Vendedor $model)
    {
        return [
            'id'         => (int) $model->id,
            'nome'       => $model->nome,
            'email'      => $model->email
        ];
    }
}
