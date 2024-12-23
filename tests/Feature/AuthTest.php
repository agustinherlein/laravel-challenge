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

    public function test_can_login_with_correct_credentials(): void
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

    public function test_cannot_login_with_wrong_credentials(): void
    {
        $user = User::factory()->create([
            "password" => bcrypt("rightPassword2")
        ]);

        $response = $this->postJson(
            '/api/auth/login',
            [
                "email" => $user->email,
                "password" => "wrongPassword1"
            ]
        );

        $response->assertStatus(401);
    }

    public function test_user_can_access_protected_routes_with_token(): void
    {
        $password = "Password3";

        $user = User::factory()->create([
            "password" => bcrypt($password)
        ]);
        $login_response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => $password
        ]);
        $token = $login_response['data']['token'];

        $response = $this->withToken($token)->getJson('api/orders');
        $response->assertStatus(200);
    }

    public function test_user_cannot_access_protected_routes_without_token(): void
    {
        $response = $this->getJson('api/orders');
        $response->assertStatus(401);
    }

}
