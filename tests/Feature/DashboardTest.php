<?php

use App\Models\Administrator;

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $user = Administrator::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});
