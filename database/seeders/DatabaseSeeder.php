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
         \App\Models\User::factory()->create([
             'name' => 'Admin User',
             'email' => 'admin@dev.com',
         ]);
         $this->call(CategoryGroupSeeder::class);
         $this->call(AccountTypeSeeder::class);
         \App\Models\User::factory(2)->create();
         \App\Models\BudgetItem::factory(2)->create();
         \App\Models\GoalDeposit::factory(2)->create();
         \App\Models\Income::factory(2)->create();
         \App\Models\Expense::factory(2)->create();
         \App\Models\Transfer::factory(2)->create();
    }
}
