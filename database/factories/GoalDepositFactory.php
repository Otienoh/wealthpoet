<?php

namespace Database\Factories;

use App\Models\Goal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoalDeposit>
 */
class GoalDepositFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'goal_id' => Goal::factory(),
            'deposited_at' => $this->faker->dateTimeThisMonth(),
            'amount' => $this->faker->biasedNumberBetween(100, 500),
        ];
    }
}
