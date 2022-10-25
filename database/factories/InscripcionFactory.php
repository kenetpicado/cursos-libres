<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InscripcionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'alumno_id' => $this->faker->numberBetween(1, 100),
            'grupo_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
