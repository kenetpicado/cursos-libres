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
            'anyo' => "2022",
            'horario' => $this->faker->time('H:i:s', 'now'),
            'duracion' => "3 MESES",
            'curso_id' => $this->faker->numberBetween(1, 10),
            'docente_id' => $this->faker->numberBetween(1, 10),
            'estado' => 1,
        ];
    }
}
