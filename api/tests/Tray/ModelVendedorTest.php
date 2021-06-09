<?php

namespace Tests\Tray;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Models Test
 * @package Tests\Feature\Tray
 */
class ModelVendedorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create Vendedor Model
     *
     * @test
     */
    public function create_a_model()
    {
        $this->assertTrue(class_exists('App\Models\Vendedor'));
    }

    /**
     * Create relationships between Vendedor and Venda
     *
     * @test
     */
    public function relationship_with_the_vendedor_and_venda()
    {
        $vendedor     = new \App\Models\Vendedor();
        $relationship = $vendedor->vendas();

        $this->assertEquals(HasMany::class, get_class($relationship), 'vendedor->vendas()');

    }


    /**
     * Create factories for Vendedor
     *
     * @test
     */
    public function create_factories()
    {
        $vendedor = \App\Models\Vendedor::factory()->create();
        $this->assertIsInt($vendedor->id,'vendedor->factory');

    }

    /**
     * Create a get nome on Vendedor model to transform
     *
     * @test
     */
    public function use_get_mutator()
    {
        $vendedor = \App\Models\Vendedor::factory()->make();
        $vendedor->nome = 'tiago farias';
        $this->assertEquals('Tiago Farias', $vendedor->nome);
    }

}
