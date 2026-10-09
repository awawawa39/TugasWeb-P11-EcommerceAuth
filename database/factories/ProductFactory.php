<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'description' => $this->faker->paragraphs(2, true),
            'price' => $this->faker->numberBetween(10000, 5000000),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => 'https://picsum.photos/seed/' . Str::random(10) . '/400/400',
        ];
    }
}