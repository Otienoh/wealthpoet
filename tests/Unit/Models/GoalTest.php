<?php

use App\Models\Goal;
use function Pest\Laravel\assertDatabaseCount;

it('can create a goal', function () {
    Goal::factory()->create();

    assertDatabaseCount('goals', 1);
});
