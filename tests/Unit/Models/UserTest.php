<?php

use App\Models\User;
use function Pest\Laravel\assertDatabaseCount;

it('can create a user', function () {
    $user = User::factory()->create();

    $categories = \App\Models\Category::count();

    assertDatabaseCount('users', 1);
    $this->assertEquals($categories, $user->category->count());
});
