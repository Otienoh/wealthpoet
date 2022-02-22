<?php

use App\Models\BudgetItem;
use function Pest\Laravel\assertDatabaseCount;

it('can create a budget item', function () {
    BudgetItem::factory()->create();

    assertDatabaseCount('budget_items', 1);
});

it('can correctly calculate the balance', function () {
    $budgetItemBalanced = BudgetItem::factory()->create([
        'goal_amount' => 0,
        'spent_amount' => 0,
    ]);

    $budgetItemUnderSpend = BudgetItem::factory()->create([
        'goal_amount' => 120,
        'spent_amount' => 50,
    ]);

    $budgetItemOverSpend = BudgetItem::factory()->create([
        'goal_amount' => 50,
        'spent_amount' => 100,
    ]);

    expect($budgetItemBalanced->balance())->toEqual(0);
    expect($budgetItemUnderSpend->balance())->toEqual(70);
    expect($budgetItemOverSpend->balance())->toEqual(-50);
});

it('can correctly determine the balance status', function () {
    $budgetItemBalanced = BudgetItem::factory()->balanced()->create();

    $budgetItemUnderSpend = BudgetItem::factory()->underspend()->create();

    $budgetItemOverSpend = BudgetItem::factory()->overspend()->create();

    expect($budgetItemBalanced->status())->toEqual(BudgetItem::STATUS_BALANCED);
    expect($budgetItemUnderSpend->status())->toEqual(BudgetItem::STATUS_UNDERSPEND);
    expect($budgetItemOverSpend->status())->toEqual(BudgetItem::STATUS_OVERSPEND);
});
