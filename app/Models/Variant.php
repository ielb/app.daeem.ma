<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'option',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
