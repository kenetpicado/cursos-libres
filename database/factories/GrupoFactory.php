<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'anyo' => $this->faker->numberBetween(2010, 2021),
            'horario' => $this->faker->time('H:i:s', 'now'),
            'duracion' => $this->faker->time('H:i:s', 'now'),
            'curso_id' => $this->faker->numberBetween(1, 10),
            'docente_id' => $this->faker->numberBetween(1, 50),
            'estado' => $this->faker->boolean(50),
        ];
    }
}
