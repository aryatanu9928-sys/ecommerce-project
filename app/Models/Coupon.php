<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'name',
        'discount_type',
        'discount_value',
        'min_cart_value',
        'max_discount',
        'usage_limit',
        'per_user_limit',
        'valid_from',
        'valid_to',
        'status'
    ];
}
