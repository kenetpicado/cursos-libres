<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'carnet' => $this->faker->unique()->regexify('[0-9]{2}-[0-9]{4}-[A-Z]{2}'),
                'nombre' => $this->faker->name,
                'edad' => $this->faker->numberBetween(18, 50),
                'celular' => $this->faker->numberBetween(60000000, 79999999),
                'ciudad' => $this->faker->city,
                'comunidad' => $this->faker->state,
                'direccion' => $this->faker->address,
        ];
    }
}
