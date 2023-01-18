<?php

namespace Database\Factories;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>fake()->sentence(6),
            'body'=>fake()->paragraphs(4,true),
            'keywords'=>fake()->words(4,true),
            'featured'=> fake()->boolean(20),
            'published'=>fake()->boolean(25),
            'description'=>fake()->sentences(3,true),
            'user_id'=>fake()->numberBetween(1,50),
        ];
    }
}
