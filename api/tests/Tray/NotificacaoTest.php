<?php

namespace Tests\Tray;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Notificacao Test
 * @package Tests\Feature\Tray
 */
class NotificacaoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o envio de notificações
     *
     * @test
     */
    public function send_vendas_notification()
    {
        Notification::fake();

        $vendedor = \App\Models\Vendedor::factory()->create();
        $vendas = \App\Models\Venda::factory()->count(3)->create([
            'vendedor_id' => $vendedor->id
        ]);

        Notification::send($vendedor,new \App\Notifications\RelatorioVendas($vendas));
        Notification::assertSentTo($vendedor, \App\Notifications\RelatorioVendas::class);
    }
}
