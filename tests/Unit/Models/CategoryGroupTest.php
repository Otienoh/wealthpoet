<?php

use App\Models\CategoryGroup;
use function Pest\Laravel\assertDatabaseCount;

it('can create a category group', function () {
    CategoryGroup::factory()->create();

    assertDatabaseCount('category_groups', 1);
});


it('can create an Income category group', function () {
    $categoryGroup = CategoryGroup::factory()->income()->create();

    expect($categoryGroup->type)->toEqual(CategoryGroup::TYPE_INCOME);
});

it('can create an Expense category group', function () {
    $categoryGroup = CategoryGroup::factory()->expense()->create();

    expect($categoryGroup->type)->toEqual(CategoryGroup::TYPE_EXPENSE);
});

it('can create a Transfer category group', function () {
    $categoryGroup = CategoryGroup::factory()->transfer()->create();

    expect($categoryGroup->type)->toEqual(CategoryGroup::TYPE_TRANSFER);
});


it('correctly identifies the retrieved model type', function () {
    $incomeCategoryGroup = CategoryGroup::factory()->income()->create();
    $expenseCategoryGroup = CategoryGroup::factory()->expense()->create();
    $tranferCategoryGroup = CategoryGroup::factory()->transfer()->create();

    expect($incomeCategoryGroup->isIncome())->toBeTruthy();
    expect($expenseCategoryGroup->isExpense())->toBeTruthy();
    expect($tranferCategoryGroup->isTransfer())->toBeTruthy();
});

it('correctly the retrieves model type based on scope', function () {
    CategoryGroup::factory()->income()->create();
    CategoryGroup::factory()->expense()->create();
    CategoryGroup::factory()->transfer()->create();

    expect(CategoryGroup::ofType(CategoryGroup::TYPE_INCOME)->count())->toEqual(1);
    expect(CategoryGroup::ofType(CategoryGroup::TYPE_EXPENSE)->count())->toEqual(1);
    expect(CategoryGroup::ofType(CategoryGroup::TYPE_TRANSFER)->count())->toEqual(1);
});

