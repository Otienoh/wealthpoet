<?php

use App\Models\Account;
use App\Models\Income;
use App\Models\Transaction;
use function Pest\Laravel\assertDatabaseCount;

it('can create an income', function () {
    Income::factory()->create();
    $transaction = Transaction::first();

    assertDatabaseCount('incomes', 1);
    assertDatabaseCount('transactions', 1);
    expect($transaction->transactionable_type)->toEqual(Income::class);
});

it('correctly updates and settles the accounts balance', function () {
    $account = Account::factory()->create([
        'initial_balance' => 1000,
    ]);

    Income::factory()->create([
        'account_id' => $account->id,
        'amount' => 500,
    ]);

    $transaction = Transaction::first();
    $account = Account::find($account->id);


    assertDatabaseCount('incomes', 1);
    assertDatabaseCount('transactions', 1);
    expect($transaction->credit)->toEqual(500);
    expect($account->balance)->toEqual(1500);
});
