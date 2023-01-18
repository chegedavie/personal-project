<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'commentable_type'=>fake()->randomElement(['App\Models\Comment','App\Models\Blog']),
            'commentable_id'=>fake()->numberBetween(0,100),
            'body'=>fake()->sentences(2,true),
            'user_id'=>fake()->numberBetween(0,100),
        ];
    }
}
