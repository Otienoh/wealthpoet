<?php

it('renders the homepage', function () {
    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee('WealthPoet: Take back control of your finances');
});
