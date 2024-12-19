<?php

use App\Models\EnumOrderStatus;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderService {

    public function create($data)
    {

        $order = Order::create([
            'total_amount' => 0,
            'status_id' => $data['status_id'] ?? EnumOrderStatus::AWAITING_PAYMENT,
            'client_id' => $data['client_id'],
            'address_id' => $data['address_id'],
        ]);

        // Associate the products with the order via the pivot table
        $total_amount = 0;
        foreach ($data['products'] as $product) {
            $number_of_items = $product['number_of_items'] ?? 1;
            $total_amount += $product['price'] * $number_of_items;
            OrderProduct::create([
                'product_id' => $product['id'],
                'order_id' => $order->id,
                'number_of_items' => $number_of_items
            ]);
        }

        $order->total_amount = $total_amount;
        $order->save();

        return $order;
    }
}