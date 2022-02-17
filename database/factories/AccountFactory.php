<?php

namespace Database\Factories;

use App\Models\AccountType;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
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
            'institution_id' => Institution::factory(),
            'account_type_id' => AccountType::factory(),
            'name' => $this->faker->name() . ' Account',
            'initial_balance' => $this->faker->biasedNumberBetween(0, 1000),
            'main' => $this->faker->boolean(30),
        ];
    }
}
