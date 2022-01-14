<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;


class OrderHasProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'variant_id',
    ];

    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product(){

        return $this->belongsTo(Product::class);
    }
 


}
