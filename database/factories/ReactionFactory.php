<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reaction>
 */
class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reactable_id'=>fake()->numberBetween(1,200),
            'reactable_type'=>fake()->randomElement(['App\Models\Blog','App\Models\Comment']),
            'user_id'=>fake()->numberBetween(1,100),
            'reaction'=>fake()->randomElement(['like','dislike']),
            'type'=>fake()->randomElement(['execute','negate']),
            'action'=>fake()->randomElement(['execute','negate']),
        ];
    }
}
