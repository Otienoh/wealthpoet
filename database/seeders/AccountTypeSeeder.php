<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            'Cash',
            'Mobile Wallet',
            'Checking Account',
            'Saving Account',
            'Investment Account',
            'Mortgage Account',
            'Loan Account',
        ])->each(function ($type) {
            AccountType::firstOrCreate([
                'name' => $type,
                'is_a_liability' => $type == 'Mortgage Account' || $type == 'Loan Account',
            ]);
        });
    }
}
