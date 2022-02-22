<?php

use App\Models\AccountType;
use function Pest\Laravel\assertDatabaseCount;

it('can create an account type', function () {
    AccountType::factory()->create();

    assertDatabaseCount('account_types', 1);
});
