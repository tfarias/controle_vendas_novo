<?php

namespace App\Presenters;

use App\Transformers\VendaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VendaPresenter.
 *
 * @package namespace App\Presenters;
 */
class VendaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VendaTransformer();
    }
}
