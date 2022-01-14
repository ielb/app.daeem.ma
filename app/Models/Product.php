<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use App\Models\Store;
use App\Models\OrderHasProduct;
use App\Models\Option;
use App\Models\Variant;



class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'sku',
        'name',
        'description',
        'image',
        'price',
        'weight',
        'subcategory_id',
        'available',
        'status',
        'has_variants',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function orderhasproducts()
    {
        return $this->belongsToMany(OrderHasProduct::class, 'order_has_statuses', 'product_id', 'order_id');
    }

    public function options()
    {
        return $this->HasMany(Option::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
