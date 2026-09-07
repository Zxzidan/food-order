<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

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

test('new user can register and password is encrypted properly', function () {
    $response = $this->post('/register', [
        'name' => 'Dandi Zaidan',
        'email' => 'dandiz@example.com',
        'password' => 'secret12345',
        'password_confirmation' => 'secret12345',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();

    $user = User::where('email', 'dandiz@example.com')->first();
    expect($user)->not->toBeNull();
    expect(Hash::check('secret12345', $user->password))->toBeTrue();
});

test('hasher check can verify sha256 fallback hash', function () {
    $salt = bin2hex(random_bytes(16));
    $hashed = '$sha256$'.$salt.'$'.hash('sha256', $salt.'mysecurepassword');

    expect(Hash::check('mysecurepassword', $hashed))->toBeTrue();
    expect(Hash::check('wrongpassword', $hashed))->toBeFalse();
});

test('user can log in even with l vs i typo in email name', function () {
    $user = User::factory()->create([
        'email' => 'dandiazaidane06@gmail.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'email' => 'dandlazaldane06@gmail.com',
        'password' => 'password123',
    ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect('/dashboard');
});
