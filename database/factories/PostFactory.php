<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'caption' => $this->faker->sentence,
            'image_path' => 'profile_photos/default.png', // À remplacer par des images si nécessaire
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
