<?php

namespace Database\Factories;

use App\Models\Venda;
use App\Models\Vendedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venda::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendedor_id' => Vendedor::factory()->create(),
            'valor' => $this->faker->randomFloat(2,1,200),
            'data' => $this->faker->dateTime
        ];
    }
}
