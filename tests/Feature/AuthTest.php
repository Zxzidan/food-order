<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated user cannot access dashboard and is redirected to login', function () {
    $response = $this->get('/dashboard');

    $response->assertRedirect('/login');
});

test('authenticated user is redirected to landing page upon logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

test('user can log in with valid credentials and access dashboard', function () {
    $user = User::factory()->create([
        'email' => 'admin@sipemma.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'email' => 'admin@sipemma.com',
        'password' => 'password123',
    ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect('/dashboard');

    $dashboardResponse = $this->get('/dashboard');
    $dashboardResponse->assertStatus(200);
});

test('user with wrong credentials cannot log in', function () {
    $user = User::factory()->create([
        'email' => 'admin@sipemma.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'email' => 'admin@sipemma.com',
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors('email');
});
