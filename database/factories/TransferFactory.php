<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
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
            'account_id' => Account::factory(),
            'destination_account_id' => Account::factory(),
            'category_id' => Category::factory(),
            'amount' => $this->faker->biasedNumberBetween(100, 500),
            'date' => $this->faker->dateTimeThisYear(),
        ];
    }
}
