<?php

declare(strict_types=1);

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Schema::create('users', function ($table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->timestamps();
    });

    config()->set('user-creator.user_model', TestUser::class);
});

it('can create a user successfully', function () {
    $this->artisan('user:create', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
    ])
        ->assertExitCode(0)
        ->expectsOutput('User created successfully.');

    expect(TestUser::where('email', 'test@example.com')->exists())->toBeTrue();
});

it('fails when user with email already exists', function () {
    TestUser::create([
        'name' => 'Existing User',
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    $this->artisan('user:create', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
    ])
        ->assertExitCode(2)
        ->expectsOutput('User with this email already exists.');
});

it('validates name is required', function () {
    $this->artisan('user:create', [
        'name' => '',
        'email' => 'test@example.com',
        'password' => 'password123',
    ])
        ->assertExitCode(2)
        ->expectsOutput('The name field is required.');
});

it('validates email format', function () {
    $this->artisan('user:create', [
        'name' => 'Test User',
        'email' => 'invalid-email',
        'password' => 'password123',
    ])
        ->assertExitCode(2)
        ->expectsOutput('The email field must be a valid email address.');
});

it('validates password minimum length', function () {
    $this->artisan('user:create', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'short',
    ])
        ->assertExitCode(2)
        ->expectsOutput('The password field must be at least 8 characters.');
});

it('creates user with hashed password', function () {
    $this->artisan('user:create', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
    ])
        ->assertExitCode(0);

    $user = TestUser::where('email', 'test@example.com')->first();
    expect($user)->not->toBeNull()
        ->and(\Illuminate\Support\Facades\Hash::check('password123', $user->password))->toBeTrue();
});

class TestUser extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password'];
}
