<?php

use App\Models\BudgetItem;
use function Pest\Laravel\assertDatabaseCount;

it('can create a budget item', function () {
    BudgetItem::factory()->create();

    assertDatabaseCount('budget_items', 1);
});

it('can correctly calculate the balance', function () {
    $budgetItem = BudgetItem::factory()->create([
        'goal_amount' => 0,
        'spent_amount' => 0,
    ]);

    $budgetItem1 = BudgetItem::factory()->create([
        'goal_amount' => 120,
        'spent_amount' => 50,
    ]);

    $budgetItem2 = BudgetItem::factory()->create([
        'goal_amount' => 50,
        'spent_amount' => 100,
    ]);

    expect($budgetItem->balance())->toEqual(0);
    expect($budgetItem1->balance())->toEqual(70);
    expect($budgetItem2->balance())->toEqual(-50);
});

it('can correctly determine the balance status', function () {
    $budgetItem = BudgetItem::factory()->create([
        'goal_amount' => 0,
        'spent_amount' => 0,
    ]);

    $budgetItem1 = BudgetItem::factory()->create([
        'goal_amount' => 120,
        'spent_amount' => 50,
    ]);

    $budgetItem2 = BudgetItem::factory()->create([
        'goal_amount' => 50,
        'spent_amount' => 100,
    ]);

    expect($budgetItem->status())->toEqual(BudgetItem::STATUS_BALANCED);
    expect($budgetItem1->status())->toEqual(BudgetItem::STATUS_UNDERSPEND);
    expect($budgetItem2->status())->toEqual(BudgetItem::STATUS_OVERSPEND);
});
