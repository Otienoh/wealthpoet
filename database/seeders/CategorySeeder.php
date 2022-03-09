<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('data/categories.json'));

        collect(json_decode($json, true))->each(function ($category) {
            $type = match ($category['type']) {
                'Income' => Category::TYPE_INCOME,
                'Expense' => Category::TYPE_EXPENSE,
                'Transfer' => Category::TYPE_TRANSFER,
            };

            $user = \App\Models\User::first();

            $parent = Category::firstOrCreate([
                'user_id' => $user->id,
                'name' => $category['name'],
                'type' => $type,
                'is_hidden' => $category['type'] == 'Transfer',
            ]);


            Category::firstOrCreate([
                'user_id' => $user->id,
                'parent_id' => $parent->id,
                'name' =>  $category['category'],
                'type' => $type,
                'is_hidden' => $category['type'] == 'Transfer',
            ]);
        });
    }
}
