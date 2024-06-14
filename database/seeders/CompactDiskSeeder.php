<?php

namespace Database\Seeders;

use App\Models\CompactDisk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompactDiskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompactDisk::factory()
            ->count(100)
            ->create();
    }
}
