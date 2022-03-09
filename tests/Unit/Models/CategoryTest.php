<?php

use App\Models\Category;
use function Pest\Laravel\assertDatabaseCount;

it('can create a category', function () {
    Category::factory()->create();

    assertDatabaseCount('categories', 1);
});

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

it('correctly the retrieves model type based on scope', function () {
    Category::factory()->income()->create();
    Category::factory()->expense()->create();
    Category::factory()->transfer()->create();

    expect(Category::ofType(Category::TYPE_INCOME)->count())->toEqual(1);
    expect(Category::ofType(Category::TYPE_EXPENSE)->count())->toEqual(1);
    expect(Category::ofType(Category::TYPE_TRANSFER)->count())->toEqual(1);
});
