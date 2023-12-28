<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();



        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            BooksTableSeeder::class,
            BookLoansTableSeeder::class,
            // Other seeders you want to run by default...
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'role_id' => 1,
            'password'=> Hash::make('12345678'),
        ]);
    }
}
