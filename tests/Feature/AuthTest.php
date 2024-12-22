<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotEmpty;

class AuthTest extends TestCase
{
    /**
     * Test register new user
     */
    public function test_register_new_user(): void
    {
        $email = fake()->safeEmail();

        $this->postJson('/api/auth/register', [
            "name" => fake()->name(),
            "email" => $email,
            "password" => "Password1",
            "password_confirmation" => "Password1"
        ]);

        assertNotEmpty(User::where('email', $email));
    }

    public function test_login_with_correct_credentials(): void
    {
        $password = "Password2";
        $user = User::factory()->create([
            "password" => bcrypt($password)
        ]);

        $response = $this->postJson(
            '/api/auth/login',
            [
                "email" => $user->email,
                "password" => $password
            ]
        );

        $response->assertStatus(200);
    }
}
