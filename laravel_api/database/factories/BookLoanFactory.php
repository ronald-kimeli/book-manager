<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Role;
use App\Models\User;
use App\Models\BookLoan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookLoan>
 */
class BookLoanFactory extends Factory
{

    protected $model = BookLoan::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bookIds = Book::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'book_id' => $this->faker->randomElement($bookIds),
            'loan_date' => $this->faker->dateTimeThisMonth(),
            'due_date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'return_date' => $this->faker->optional()->dateTimeThisMonth(),
            'extended' => $this->faker->optional()->randomElement(['Yes', 'No']),
            'extension_date' => $this->faker->optional()->dateTimeThisMonth(),
            'penalty_amount' => $this->faker->optional()->randomNumber(2),
            'penalty_status' => $this->faker->optional()->randomElement(['Paid', 'Unpaid']),
            'status' => $this->faker->randomElement(['Active', 'Returned'])
        ];
    }
}
