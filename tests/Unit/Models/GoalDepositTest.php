<?php

use App\Models\GoalDeposit;
use function Pest\Laravel\assertDatabaseCount;

it('can create a goal deposit', function () {
    GoalDeposit::factory()->create();

    assertDatabaseCount('goal_deposits', 1);
});
