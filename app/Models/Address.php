<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $fillable = [
        'street_address',
        'city',
        'province',
        'postal_code',
        'country',
        'additional_information'
    ];
}
