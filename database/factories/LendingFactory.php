<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lending>
 */
class LendingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = \App\Models\User::role(['lecturer', 'student'])->pluck('id')->toArray();
        $books = \App\Models\Book::pluck('id')->toArray();
        $compactDisks = \App\Models\CompactDisk::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($users),
            'book_id' => $this->faker->randomElement($books),
            'compact_disk_id' => $this->faker->randomElement($compactDisks),
            'lending_date' => $this->faker->date(),
            'return_date' => $this->faker->date(),
            'return_date_real' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'lent', 'returned', 'overdue', 'extend', 'rejected']),
            'fine' => $this->faker->numberBetween(0, 100),
            'extend_date' => $this->faker->date(),
        ];
    }
}
