<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'discount_price',
        'active_from',
        'active_to',
        'limit_to_num_uses',
        'used_count',
        'status'
    ];
}
