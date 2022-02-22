<?php

use App\Models\CategoryGroup;
use function Pest\Laravel\assertDatabaseCount;

it('can create a category group', function () {
    CategoryGroup::factory()->create();

    assertDatabaseCount('category_groups', 1);
});
