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
