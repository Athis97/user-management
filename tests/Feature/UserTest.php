<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_register_user()
    {
        $userData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'role' => 'Admin',
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'location' => [
                'latitude' => 37.7749,
                'longitude' => -122.4194,
            ],
            'dob' => '2000-01-01',
            'timezone' => 'UTC',
        ];

        $response = $this->postJson('/api/register', $userData);
        $response->assertStatus(201)->assertJson(['message' => 'User registered successfully']);
    }

    public function test_can_login_user()
    {
        $email = fake()->unique()->safeEmail();
        $user = User::factory()->create([
            'email' => $email,
            'password' => 'password'
        ]);

        $credentials = ['email' => $email, 'password' => 'password'];

        $response = $this->postJson('/api/login', $credentials);
        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    public function test_can_get_all_users()
    {
        $email = fake()->unique()->safeEmail();
        $user = User::factory()->create([
            'email' => $email,
            'password' => 'password'
        ]);

        $token = auth()->attempt(['email' => $email, 'password' => 'password']);
        $response = $this->getJson('/api/users', ['Authorization' => "Bearer $token"]);
        $response->assertStatus(200)->assertJsonStructure([['id', 'first_name', 'last_name', 'role', 'email', 'location', 'dob', 'timezone']]);
    }

    public function test_can_get_single_user()
    {
        $email = fake()->unique()->safeEmail();
        $user = User::factory()->create([
            'email' => $email,
            'password' => 'password'
        ]);

        $token = auth()->attempt(['email' => $email, 'password' => 'password']);

        $response = $this->getJson("/api/users/{$user->id}", ['Authorization' => "Bearer $token"]);
        $response->assertStatus(200)->assertJsonStructure(['id', 'first_name', 'last_name', 'role', 'email', 'location', 'dob', 'timezone']);
    }

    public function test_can_update_user()
    {
        $email = fake()->unique()->safeEmail();
        $user = User::factory()->create([
            'email' => $email,
            'password' => 'password'
        ]);

        $token = auth()->attempt(['email' => $email, 'password' => 'password']);

        $updateData = ['first_name' => 'Jane'];

        $response = $this->putJson("/api/users/{$user->id}", $updateData, ['Authorization' => "Bearer $token"]);
        $response->assertStatus(200)->assertJson(['first_name' => 'Jane']);
    }

    public function test_can_delete_user()
    {
        $email = fake()->unique()->safeEmail();
        $user = User::factory()->create([
            'email' => $email,
            'password' => 'password'
        ]);

        $token = auth()->attempt(['email' => $email, 'password' => 'password']);

        $response = $this->deleteJson("/api/users/{$user->id}", [], ['Authorization' => "Bearer $token"]);
        $response->assertStatus(200)->assertJson(['message' => 'User deleted']);
    }
}
