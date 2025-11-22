<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Income::factory()->count(10)->create();
    }
}
