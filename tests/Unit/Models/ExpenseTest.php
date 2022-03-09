<?php

use App\Models\Account;
use App\Models\Expense;
use App\Models\Transaction;
use function Pest\Laravel\assertDatabaseCount;

it('can create an expense', function () {
    Expense::factory()->create();
    $transaction = \App\Models\Transaction::first();

    assertDatabaseCount('expenses', 1);
    assertDatabaseCount('transactions', 1);
    expect($transaction->transactionable_type)->toEqual(Expense::class);
});


it('correctly updates and settles the accounts balance', function () {
    $account = Account::factory()->create([
        'initial_balance' => 1000,
    ]);

    Expense::factory()->create([
        'account_id' => $account->id,
        'amount' => 300,
    ]);


    $transaction = Transaction::first();
    $account = Account::find($account->id);


    assertDatabaseCount('transactions', 1);
    expect($transaction->debit)->toEqual(300);
    expect($account->balance)->toEqual(700);
});
