<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
            'author' => $this->faker->name,
            'isbn' => $this->faker->randomNumber(8),
            'cover' =>  $this->faker->imageUrl(),
            'description' => $this->faker->name,
            'publisher' => $this->faker->name,
            'language' => $this->faker->name,
            'edition' => $this->faker->randomNumber(2),
            'subject' => $this->faker->name,
            'classification' => $this->faker->name,
            'cp_or' => $this->faker->name,
            'year' => $this->faker->randomNumber(4),
            'status' => $this->faker->randomElement([1, 2, 3]),
            'quantity' => $this->faker->randomNumber(2),
            'available' => $this->faker->randomNumber(2),
        ];
    }
}
