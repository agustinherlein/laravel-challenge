<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotEmpty;

class CreateOrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test that the OrderService can create an order when receiving the correct parameters
     */
    public function test_the_order_service_can_create_an_order(): void
    {
        $this->seed();
        $data = [
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
        $orderService = new OrderService;
        $order = $orderService->create($data);

        assertNotEmpty(Order::where("id", $order->id));
    }


}
