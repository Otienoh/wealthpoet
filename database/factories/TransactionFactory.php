<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'account_id' => Account::factory(),
            'category_id' => Category::factory(),
            'amount' => $this->faker->numberBetween(50, 20000),
            'description' => $this->faker->paragraph(),
            'transaction_date' => $this->faker->dateTimeThisYear(),
            'transaction_reference' => $this->faker->sentences(),
            'hidden' => $this->faker->boolean(40),
            'debit' => $this->faker->numberBetween(0, 10000),
            'credit' => $this->faker->numberBetween(0, 10000),
        ];
    }

    public function income()
    {
        Income::factory()->create();
    }

    public function expense()
    {
        Expense::factory()->create();
    }

    public function transfer()
    {
        Transfer::factory()->create();
    }
}
