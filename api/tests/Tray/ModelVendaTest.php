<?php

namespace Tests\Tray;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Models Test
 * @package Tests\Feature\Tray
 */
class ModelVendaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create Venda Model
     *
     * @test
     */
    public function create_a_model()
    {
        $this->assertTrue(class_exists('App\Models\Venda'));
    }

    /**
     * Create relationships between Venda and Vendedor
     *
     * @test
     */
    public function relationship_with_the_venda_and_vendedor()
    {
        $venda     = new \App\Models\Venda();
        $relationship = $venda->vendedor();

        $this->assertEquals(BelongsTo::class, get_class($relationship), 'venda->vendedor()');

    }


    /**
     * Create factories for Venda
     *
     * @test
     */
    public function create_factories()
    {
        $venda = \App\Models\Venda::factory()->create();
        $this->assertIsInt($venda->vendedor->id,'venda->vendedor()');

    }

    /**
     * Create a get valor on Venda model to transform
     *
     * @test
     */
    public function use_get_mutator()
    {
        $venda = \App\Models\Venda::factory()->make();
        $venda->valor = "100,00";
        $this->assertEquals(100.0, $venda->valor);
    }

    /**
     * Create a get comissao on Venda model to transform
     * testa se valor da comissão da venda de 200 reais será 17,00 de acordo com 8,5 de percentual de comissão
     * @test
     */
    public function use_get_mutator_comissao()
    {
        $venda = \App\Models\Venda::factory()->make();
        $venda->valor = "200,00";
        $this->assertEquals(17.0, $venda->comissao);
    }

}
