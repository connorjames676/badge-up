<?php

namespace Database\Factories;

use App\Models\MyUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Challenge>
 */
class ChallengeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText('20'),
            'description' => fake()->realText('100', 3),
            'start_date' => fake()->dateTimeBetween($endDate = 'now'),
            'end_date' => fake()->dateTimeBetween($startDate = '+1 day', $endDate = '+1 year'),
            'coach_id' => fake()->numberBetween(1, 50), //CHANGE if MyUser factory produces less than 50!
        ];
    }
}
