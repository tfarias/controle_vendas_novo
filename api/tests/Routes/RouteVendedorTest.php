<?php
namespace Tests\Routes;

use App\Models\Vendedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class RouteVendedorTest
 * @package Tests\Routes
 */
class RouteVendedorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create route
     *
     * @test
     */
    public function route_vendedor()
    {
       $data = Vendedor::factory()->make()->toArray();

        $this->post(env('APP_URL').'/vendedor',$data);

        $this->assertDatabaseHas('vendedor', [
            "nome" => $data['nome'],
            "email" => $data['email']
        ]);
    }

    /**
     * Valida a obrigatoriedade do nome e e-mail
     *
     * @test
     */
    public function validate_the_payload_nome_and_email()
    {

        $this->postJson(env('APP_URL').'/vendedor')
            ->assertJsonValidationErrors([
                'nome',
                'email'
            ]);


    }

    /**
     * Valida a obrigatoriedade do email valido
     *
     * @test
     */
    public function validate_the_payload_email_valid()
    {

        $this->postJson(env('APP_URL').'/vendedor', ['email' => 'email_invalid'])
            ->assertJsonValidationErrors([
                'email'
            ]);

    }

    /**
     * Valida o email unique
     *
     * @test
     */
    public function validate_the_payload_email_unique()
    {

        $data = [
            "nome" => "Dr Rocio Homenick Jr",
            "email" => "olinratkess@gmailcom",
        ];

        $this->postJson(env('APP_URL').'/vendedor', $data);

        $this->postJson(env('APP_URL').'/vendedor', $data)
            ->assertJsonValidationErrors([
                'email'
            ]);

    }


}
