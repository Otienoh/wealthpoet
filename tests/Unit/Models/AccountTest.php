<?php

use App\Models\Account;
use function Pest\Laravel\assertDatabaseCount;

it('can create an account', function () {
    Account::factory()->create();

    assertDatabaseCount('accounts', 1);
});
