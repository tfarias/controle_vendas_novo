<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property Venda $venda
 */

class Vendedor extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = "vendedor";

    protected $fillable = [
        'nome',
        'email'
    ];

    protected $dates = ['deleted_at'];

    protected function getNomeAttribute(){
        return ucwords($this->attributes['nome']);
    }

    public function vendas(){
        return $this->hasMany(Venda::class);
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }
}
