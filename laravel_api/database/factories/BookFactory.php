<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // Only admins are allowed to add books
        $users = User::all();
        $adminUserId = null;

        foreach ($users as $user) {
            $roleId = $user->role_id;
            $roleName = Role::where('id', $roleId)->value('name');

            if ($roleName === 'admin') {
                $adminUserId = $user->id;
                break;
            }
        }
        
        return [
            'name' => $this->faker->sentence,
            'added_by' => $adminUserId,
            'publisher' => $this->faker->company,
            'isbn' => $this->faker->isbn13,
            'category' => $this->faker->word,
            'sub_category' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'pages' => $this->faker->numberBetween(50, 500),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['Available', 'Booked'])
        ];
    }
}
