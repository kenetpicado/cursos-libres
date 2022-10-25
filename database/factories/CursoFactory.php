<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'estado' => $this->faker->boolean(50),
        ];
    }
}
