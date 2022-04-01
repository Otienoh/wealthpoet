<?php

use App\Models\Expense;
use App\Models\Income;
use App\Models\Transaction;
use App\Models\Transfer;
use function Pest\Laravel\assertDatabaseCount;

it('can create an income transaction', function () {
    $income = Income::factory()->create();

    $transaction = Transaction::first();

    assertDatabaseCount('transactions', 1);
    $this->assertEquals(Income::class, $transaction->transactionable_type);
    $this->assertEquals($income->id, $transaction->transactionable_id);
    $this->assertEquals($income->amount, $transaction->amount);
});

it('can create an expense transaction', function () {
    $expenses = Expense::factory()->create();

    $transaction = Transaction::first();

    assertDatabaseCount('transactions', 1);
    $this->assertEquals(Expense::class, $transaction->transactionable_type);
    $this->assertEquals($expenses->id, $transaction->transactionable_id);
    $this->assertEquals($expenses->amount, $transaction->amount);
});

it('can create a transfer transaction', function () {
    $transfer = Transfer::factory()->create();

    $transaction = Transaction::all();

    assertDatabaseCount('transactions', 2);
    // Logs the Transfer Debit Entry
    $this->assertEquals(Transfer::class, $transaction[0]['transactionable_type']);
    $this->assertEquals($transfer->id, $transaction[0]['transactionable_id']);
    $this->assertEquals($transfer->account_id, $transaction[0]['account_id']);
    $this->assertEquals($transfer->amount, $transaction[0]['amount']);
    $this->assertEquals($transfer->amount, $transaction[0]['debit']);
    $this->assertEquals(0, $transaction[0]['credit']);
    // Logs the Transfer Credit Entry
    $this->assertEquals(Transfer::class, $transaction[1]['transactionable_type']);
    $this->assertEquals($transfer->id, $transaction[1]['transactionable_id']);
    $this->assertEquals($transfer->destination_account_id, $transaction[1]['account_id']);
    $this->assertEquals($transfer->amount, $transaction[1]['amount']);
    $this->assertEquals($transfer->amount, $transaction[1]['credit']);
    $this->assertEquals(0, $transaction[1]['debit']);
});
