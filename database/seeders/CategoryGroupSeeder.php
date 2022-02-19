<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategoryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/categories.json");

        collect(json_decode($json, true))->each(function ($categoriesGroup) {
            $type = match ($categoriesGroup['type']) {
                'Income' => CategoryGroup::INCOME,
                'Expense' => CategoryGroup::EXPENSE,
                'Transfer' => CategoryGroup::TRANSFER,
            };

            CategoryGroup::firstOrCreate([
                'user_id' => 1,
                'name' => $categoriesGroup['name'],
                'type' => $type,
                'is_hidden' => $categoriesGroup['type'] == 'Transfer',
            ])->categories()->create([
                'name' => $categoriesGroup['category'],
            ]);
        });
    }
}
