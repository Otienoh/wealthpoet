<?php

use App\Models\Category;
use function Pest\Laravel\assertDatabaseCount;

it('can create an Income category', function () {
    $Category = Category::factory()->income()->create();

    expect($Category->type)->toEqual(Category::TYPE_INCOME);
});

it('can create an Expense category', function () {
    $Category = Category::factory()->expense()->create();

    expect($Category->type)->toEqual(Category::TYPE_EXPENSE);
});

it('can create a Transfer category', function () {
    $Category = Category::factory()->transfer()->create();

    expect($Category->type)->toEqual(Category::TYPE_TRANSFER);
});

it('correctly identifies the retrieved model type', function () {
    $incomeCategory = Category::factory()->income()->create();
    $expenseCategory = Category::factory()->expense()->create();
    $tranferCategory = Category::factory()->transfer()->create();

    expect($incomeCategory->isIncome())->toBeTruthy();
    expect($expenseCategory->isExpense())->toBeTruthy();
    expect($tranferCategory->isTransfer())->toBeTruthy();
});

