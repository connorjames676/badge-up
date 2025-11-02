<?php

namespace Database\Factories;

use App\Models\MyUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generates random text (seems the best way to replicate a bio)
            'bio' => fake()->realText(100, 3),
            'number_of_badges' => fake()->randomFloat(0, 0, 50),
            // Generates a my_user_id from the next available user in the my_user table
            'my_user_id' => MyUser::inRandomOrder()->first()->id, 
        ];
    }
}
