<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'paid_at',
        'total_amount',
        'status_id',
        'client_id',
        'address_id'
    ];

    public function client() : BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function address() : HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
