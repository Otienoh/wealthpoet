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
            'goal_amount' => $this->faker->randomNumber(),
            'spent_amount' => $this->faker->randomNumber(),
        ];
    }
}
