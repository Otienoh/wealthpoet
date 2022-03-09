<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CategoryFactory extends Factory
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
            'name' => $this->faker->word().' Category',
            'type' => $this->faker->randomElement([Category::TYPE_INCOME, Category::TYPE_EXPENSE]),
            'is_hidden' => $this->faker->boolean(),
        ];
    }

    public function income()
    {
        return $this->state([
            'type' => Category::TYPE_INCOME,
        ]);
    }

    public function expense()
    {
        return $this->state([
            'type' => Category::TYPE_EXPENSE,
        ]);
    }

    public function transfer()
    {
        return $this->state([
            'type' => Category::TYPE_TRANSFER,
        ]);
    }
}
