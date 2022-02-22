<?php

use App\Models\Budget;
use function Pest\Laravel\assertDatabaseCount;

it('can create a budget', function () {
    Budget::factory()->create();

    assertDatabaseCount('budgets', 1);
});

it('can create a monthly budget', function () {
    $budget = Budget::factory()->monthly()->create();

    expect($budget->type)->toEqual(Budget::TYPE_MONTHLY);
});

it('can create a custom budget', function () {
    $budget = Budget::factory()->custom()->create();

    expect($budget->type)->toEqual(Budget::TYPE_CUSTOM);
});

it('correctly identifies the retrieved model type', function () {
    $customBudget = Budget::factory()->custom()->create();
    $monthlyBudget = Budget::factory()->monthly()->create();

    expect($customBudget->isACustomBudget())->toBeTruthy();
    expect($monthlyBudget->isAMonthlyBudget())->toBeTruthy();
});

it('can correctly calculate the totalSpending', function () {

    $budgetWithUnderSpendBudgetItems = Budget::factory()
                                        ->has(\App\Models\BudgetItem::factory()
                                            ->underspend()
                                            ->count(2)
                                        )->create();

    expect($budgetWithUnderSpendBudgetItems->totalSpending())->toEqual(100);
});

it('can correctly determine the balance status', function () {
    $budgetWithBalancedBudgetItems = Budget::factory()
                                        ->has(\App\Models\BudgetItem::factory()
                                            ->balanced()
                                            ->count(2)
                                        )->create(['income_spending_goal' => 0]);

    $budgetWithUnderSpendBudgetItems = Budget::factory()
                                        ->has(\App\Models\BudgetItem::factory()
                                            ->underspend()
                                            ->count(2)
                                        )->create(['income_spending_goal' => 500]);

    $budgetWithOverSpendBudgetItems = Budget::factory()
                                        ->has(\App\Models\BudgetItem::factory()
                                            ->overspend()
                                            ->count(2)
                                        )->create(['income_spending_goal' => 50]);

    expect($budgetWithBalancedBudgetItems->status())->toEqual(Budget::STATUS_BALANCED);
    expect($budgetWithUnderSpendBudgetItems->status())->toEqual(Budget::STATUS_UNDERSPEND);
    expect($budgetWithOverSpendBudgetItems->status())->toEqual(Budget::STATUS_OVERSPEND);
});
