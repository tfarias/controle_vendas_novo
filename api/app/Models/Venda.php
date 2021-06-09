<?php

namespace App\Models;

use App\Models\Traits\Currency;
use App\Models\Traits\CurrentDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $vendedor_id
 * @property string|float|numeric $valor
 * @property string|Carbon $data
 * @property Vendedor $vendedor
 * @property float $comissao
 */
class Venda extends Model
{
    use HasFactory, SoftDeletes, Currency, CurrentDate;

    protected $table = "venda";

    protected $fillable = [
        'vendedor_id',
        'valor',
        'data'
    ];

    protected $attributes = [
        'data' => null
    ];

    protected $dates = ['deleted_at', 'data'];

    protected function setValorAttribute($valor){
        $this->attributes['valor'] = self::getAmount($valor);
    }

    protected function getValorAttribute(){
        return round(self::getAmount($this->attributes['valor']),2);
    }

    protected function getComissaoAttribute(){
        $perComissao = env('VALOR_COMISSAO');
        if(floatval($perComissao)>0){
            return round((self::getAmount($this->attributes['valor']) * ($perComissao/100)),2);
        }
    }

    public function vendedor(){
        return $this->belongsTo(Vendedor::class);
    }

}
