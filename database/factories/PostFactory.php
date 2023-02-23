<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(5, true),
            'created_at'    => $this->faker->date($format='Y-m-d', $max='now'),
            'updated_at'    => $this->faker->date($format='Y-m-d', $max='now'),
            'published_at'    => $this->faker->date($format='Y-m-d', $max='now'),
            'body'    => $this->faker->sentences(150),
            'exerpt'    => $this->faker->sentences(2),
            'visibility'    => $this->faker->boolean(),
            'is_published'    => $this->faker->boolean(),
            'is_deleted'    => $this->faker->boolean()
        ];
    }
}