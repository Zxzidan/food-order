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

test('database admin account can log in with email or username and access dashboard', function () {
    $admin = User::factory()->create([
        'name' => 'Dandi Azaidane',
        'email' => 'admin@sipemma.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // Test dengan email penuh
    $responseEmail = $this->post('/login', [
        'email' => 'admin@sipemma.com',
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($admin);
    $responseEmail->assertRedirect('/dashboard');

    $this->post('/logout');

    // Test dengan keyword username 'admin'
    $responseUsername = $this->post('/login', [
        'email' => 'admin',
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($admin);
    $responseUsername->assertRedirect('/dashboard');

    $this->post('/logout');

    // Test dengan keyword 'juri' dialihkan ke admin
    $responseJuri = $this->post('/login', [
        'email' => 'juri',
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($admin);
    $responseJuri->assertRedirect('/dashboard');
});

test('login page displays juri quick login helper and credentials with database account', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSee('Akun Khusus Juri');
    $response->assertSee('admin@sipemma.com');
    $response->assertSee('Masuk Cepat sebagai Juri');
});
