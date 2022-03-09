<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word().' Budget',
            'type' => $this->faker->randomElement([Budget::TYPE_MONTHLY, Budget::TYPE_CUSTOM]),
            'total_income' => $this->faker->biasedNumberBetween(100, 500),
            'income_spending_goal' => $this->faker->biasedNumberBetween(100, 500),
        ];
    }

    public function monthly()
    {
        return $this->state([
            'type' => Budget::TYPE_MONTHLY,
        ]);
    }

    public function custom()
    {
        return $this->state([
            'type' => Budget::TYPE_CUSTOM,
        ]);
    }
}
