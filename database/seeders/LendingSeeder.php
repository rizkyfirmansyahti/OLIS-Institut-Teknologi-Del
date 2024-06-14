<?php

namespace Database\Seeders;

use App\Models\Lending;
use Illuminate\Database\Seeder;

class LendingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lending::factory()->count(100)->create();
    }
}
