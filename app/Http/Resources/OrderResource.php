<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->cod,
            'client_name' => $this->client->full_name,
            'client_email' => $this->client->email,
            'address' => $this->address->street_address . ', ' . $this->address->city . ', ' . $this->address->country,
            'total_amount' => $this->total_amount,
            'products' => ProductResource::collection($this->products)
        ];
    }
}
