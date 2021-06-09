<?php
namespace Tests\Routes;

use App\Models\Venda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class RouteVendaTest
 * @package Tests\Routes
 */
class RouteVendaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create route
     *
     * @test
     */
    public function route_venda()
    {
       $data = Venda::factory()->make()->toArray();

        $this->post(env('APP_URL').'/venda',$data);

        $this->assertDatabaseHas('venda', [
            "vendedor_id" => $data['vendedor_id'],
            "valor" => $data['valor']
        ]);
    }

    /**
     * Valida a obrigatoriedade do vendedor e valor
     *
     * @test
     */
    public function validate_the_payload_vendedor_and_valor()
    {

        $this->postJson(env('APP_URL').'/venda')
            ->assertJsonValidationErrors([
                'vendedor_id',
                'valor'
            ]);


    }

    /**
     * Valida vendedor exists
     *
     * @test
     */
    public function validate_the_payload_exist_vendedor()
    {

        $this->postJson(env('APP_URL').'/venda', ['vendedor_id' => 'vendedor_invalid'])
            ->assertJsonValidationErrors([
                'vendedor_id'
            ]);

    }




}
