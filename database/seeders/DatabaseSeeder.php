<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(4)->create();
         \App\Models\Account::factory(2)->create();
         \App\Models\BudgetItem::factory(3)->create();
         \App\Models\CategoryGroup::factory(5)->create();
         \App\Models\GoalDeposit::factory(5)->create();
         \App\Models\Income::factory(5)->create();
         \App\Models\Expense::factory(5)->create();
         \App\Models\Transfer::factory(5)->create();
    }
}
