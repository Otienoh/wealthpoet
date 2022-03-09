<?php

use App\Models\Account;
use App\Models\Income;
use App\Models\Transaction;
use App\Models\Transfer;
use function Pest\Laravel\assertDatabaseCount;

it('can create a transfer', function () {
    Transfer::factory()->create();
    $transaction = Transaction::first();

    assertDatabaseCount('transfers', 1);
    assertDatabaseCount('transactions', 2);
    expect($transaction->transactionable_type)->toEqual(Transfer::class);
});

it('correctly updates and settles the accounts balance', function () {
    $sourceAccount = Account::factory()->create([
        'initial_balance' => 10000,
    ]);

    $destinationAccount = Account::factory()->create([
        'initial_balance' => 2000,
    ]);

    Transfer::factory()->create([
        'account_id' => $sourceAccount->id,
        'destination_account_id' => $destinationAccount->id,
        'amount' => 3000,
    ]);

    $transaction = Transaction::get()->toArray();
    $sourceAccount = Account::find($sourceAccount->id);
    $destinationAccount = Account::find($destinationAccount->id);


    assertDatabaseCount('transfers', 1);
    assertDatabaseCount('transactions', 2);
    expect($transaction[0]['debit'])->toEqual(3000);
    expect($transaction[0]['credit'])->toEqual(0);
    expect($transaction[1]['debit'])->toEqual(0);
    expect($transaction[1]['credit'])->toEqual(3000);
    expect($sourceAccount->balance)->toEqual(7000);
    expect($destinationAccount->balance)->toEqual(5000);
});
