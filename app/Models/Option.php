<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'options',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
