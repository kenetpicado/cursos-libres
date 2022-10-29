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
            'carnet' => $this->faker->unique()->regexify('22-[0-9]{4}-LE'),
            'nombre' => $this->faker->name,
            'edad' => $this->faker->numberBetween(18, 50),
            'celular' => $this->faker->numberBetween(60000000, 79999999),
            'ciudad' => $this->faker->city,
            'comunidad' => $this->faker->state,
            'direccion' => $this->faker->address,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
