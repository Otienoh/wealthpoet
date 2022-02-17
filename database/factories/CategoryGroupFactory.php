<?php

namespace Database\Factories;

use App\Models\CategoryGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryGroup>
 */
class CategoryGroupFactory extends Factory
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
            'name' => $this->faker->word() . ' Category Group',
            'type' => $this->faker->randomElement([CategoryGroup::INCOME,CategoryGroup::EXPENSE])
        ];
    }
}
