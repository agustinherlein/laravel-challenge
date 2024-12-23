<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotEmpty;

class CreateOrderTest extends TestCase
{
    use RefreshDatabase;
    private function getCreateOrderData()
    {
        return [
            "address_id" => 1,
            "client_id" => 2,
            "items" => [
                [
                    "id" => 1,
                    "amount" => 3
                ],
                [
                    "id" => 3
                ]
            ]
        ];
    }

    /**
     * Test that the OrderService can create an order when receiving the correct parameters
     */
    public function test_the_order_service_can_create_an_order(): void
    {
        $data = $this->getCreateOrderData();
        $orderService = new OrderService;
        $order = $orderService->create($data);

        assertNotEmpty(Order::where("id", $order->id));
    }

    public function test_user_can_create_order_through_the_api(): void
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

        $response = $this->withToken($token)->postJson('/api/orders', $this->getCreateOrderData());
        $response->assertStatus(200);
    }
}
