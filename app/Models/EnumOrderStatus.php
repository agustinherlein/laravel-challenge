<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnumOrderStatus extends Model
{
    const AWAITING_PAYMENT = 1;
    const PAID = 2;
    const IN_TRANSIT = 3;
    const DELIVERED = 4;
    const CANCELLED = 5;
    
    protected $table = 'enum_order_status';
    protected $fillable = [ 'cod' ];
}
