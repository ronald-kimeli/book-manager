<?php

namespace Database\Seeders;

use App\Models\BookLoan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookLoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookLoan::factory()->count(20)->create(); // Adjust the count as needed
    }
}
