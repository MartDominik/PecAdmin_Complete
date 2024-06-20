<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\hirdetes>
 */
class hirdetesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'userid'  => fake()->name(),
            'versenynev' => fake()->name(),
            'tipus' => fake()->name(),
            'helyszinid' => fake()->name(),
            'idopont' => fake()->name(),
            'rovidleiras' => fake()->name(),
            'szabalyzat' => fake()->name(),
            'leiras' => fake()->name()
        ];
    }
}
