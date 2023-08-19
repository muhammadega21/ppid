<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(6, 8)),
            'slug' => $this->faker->slug(),
            // 'body' => '<p>' . implode('</p><p>',$this->faker->paragraphs(mt_rand(5,10))) . '</p>',
            'content' => collect($this->faker->paragraphs(mt_rand(10, 15)))->map(fn ($p) => "<p>$p</p>")->implode(''),
            'image' => 'images/IPYs04MrS4JriiEdkHRf3BcRl3F88oOrsWpi3Odx.png',
            'user_id' => mt_rand(1, 3),
            'category_id' => mt_rand(1, 3),
            'post_tag' => "anime,politik,olahraga"
        ];
    }
}
