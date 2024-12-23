<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseApiController;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends BaseApiController
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(OrderResource::collection(Order::all()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $order = $this->orderService->create($data);
            return $this->sendResponse($order, "Se guardó correctamente la orden $order->id");
        } catch (Exception $e) {
            return dd($e->getMessage());
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $this->sendResponse(new OrderResource($order));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
