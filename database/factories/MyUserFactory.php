<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MyUser>
 */
class MyUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password'=> fake()->password(),
            'age' => fake()->randomFloat(0, 18, 84),
            'role' => fake()->randomElement(['coach', 'participant']),
        ];
    }
}
