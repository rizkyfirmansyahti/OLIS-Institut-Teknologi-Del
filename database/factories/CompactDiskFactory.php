<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompactDisk>
 */
class CompactDiskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'subject' => $this->faker->name,
            'author' => $this->faker->name,
            'description' => $this->faker->name,
            'source' => $this->faker->name,
            'cover' =>  $this->faker->imageUrl(),
            'major' => $this->faker->name,
            'category' => $this->faker->name,
            'year' => $this->faker->randomNumber(4),
        ];
    }
}
