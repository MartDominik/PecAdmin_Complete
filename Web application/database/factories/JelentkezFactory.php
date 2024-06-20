<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jelentkez>
 */
class jelentkezFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hirdetId' => fake()->numberBetween(1,2),
            'nev' => fake()->name(),
            'telefonszam' => fake()->phoneNumber(),
            'email' => fake()->email(),

        ];
    }
}
