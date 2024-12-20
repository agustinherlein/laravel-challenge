<?php

namespace App\Services;

use App\Models\EnumOrderStatus;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use stdClass;

class OrderService {

    public function show($order_id)
    {
        return Order::find($order_id)->with('address', 'client', 'products')->get();
    }

    public function create($data)
    {
        $order = Order::create([
            'total_amount' => 0,
            'status_id' => $data['status_id'] ?? EnumOrderStatus::AWAITING_PAYMENT,
            'client_id' => $data['client_id'],
            'address_id' => $data['address_id'],
        ]);

        $total_amount = 0;
        foreach ($data['items'] as $item) {
            // Retrieve product from database
            $product = Product::find($item['id']);
            if(!$product){
                throw new Exception("Failed creating order. Could not find a product with id = " . $item['id']);
            }

            // Add the price of the product to the total amount of the order
            $amount = $item['amount'] ?? 1;
            $total_amount += $product->price * $amount;

            // Associate the products with the order via the pivot table
            $order->products()->attach($product->id, ['amount' => $amount]);
        }

        $order->total_amount = $total_amount;
        $order->save();

        return $order;
    }
}