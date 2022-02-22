<?php

namespace Database\Factories;

use App\Models\Budget;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BudgetItem>
 */
class BudgetItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'budget_id' => Budget::factory(),
            'name' => $this->faker->word() . ' Budget Item',
            'goal_amount' => $this->faker->biasedNumberBetween(100, 500),
            'spent_amount' => $this->faker->biasedNumberBetween(100, 500),
        ];
    }

    public function balanced()
    {
        return $this->state([
            'goal_amount' => 0,
            'spent_amount' => 0,
        ]);
    }

    public function underspend()
    {
        return $this->state([
            'goal_amount' => 100,
            'spent_amount' => 50,
        ]);
    }

    public function overspend()
    {
        return $this->state([
            'goal_amount' => 50,
            'spent_amount' => 100,
        ]);
    }
}
