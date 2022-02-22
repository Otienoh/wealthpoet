<?php

use App\Models\Institution;
use function Pest\Laravel\assertDatabaseCount;

it('can create an institution', function () {
    Institution::factory()->create();

    assertDatabaseCount('institutions', 1);
});
