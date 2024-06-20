<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\helyszinek>
 */
class helyszinekFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nev' => fake()->name(),
            'befogadohelyek' => Str::random(2),
            'helyszin' => fake()->city(),
            'kep' => fake()->name(),
            ];
    }
}
