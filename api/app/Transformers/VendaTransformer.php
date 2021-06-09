<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Venda;

/**
 * Class VendaTransformer.
 *
 * @package namespace App\Transformers;
 */
class VendaTransformer extends TransformerAbstract
{
    /**
     * Transform the Venda entity.
     *0/05/2021 00:00:00
9	Vendedor Teste	tiaguitog3@gmail.com	10,20	120,00	31/05/2021 00:00:00
     * @param \App\Models\Venda $model
     *
     * @return array
     */
    public function transform(Venda $model)
    {
        return [
            'id'         => (int) $model->id,
            'vendedor'  => [
                'id' => $model->vendedor->id,
                'nome' => $model->vendedor->nome,
                'email' => $model->vendedor->email,
            ],
            'comissao'   => number_format($model->comissao,2,',','.'),
            'valor_venda'=> number_format($model->valor,2,',','.'),
            'data_venda' => $model->data->format('d/m/Y H:i:s')
        ];
    }
}
