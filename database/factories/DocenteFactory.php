<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'celular' => $this->faker->regexify('[0-9]{8}'),
            'tipo_pago' => $this->faker->randomElement(['PORCENTAJE', 'FIJO']),
            'viatico' => $this->faker->randomFloat(2, 0, 100),
            'estado' => 1,
        ];
    }
}
