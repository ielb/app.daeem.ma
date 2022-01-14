<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderHasProduct;
use App\Models\OrderHasStatus;
use App\Models\Status;
use App\Models\Product;
use App\Models\User;
use App\Models\Client;
use App\Models\Store;
use App\Models\Address;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'address_id',
        'client_id',
        'store_id',
        'user_id',
        'collector_id',
        'status_id',
        'delivery_price',
        'order_price',
        'use_coupon',
        'price_after_coupon',
        'discount_price',
        'payment_method',
        'use_delivery_time',
        'delivery_time',
        'delivery_pickup_interval',
        'invoice_images',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function collector()
    {
        return $this->belongsTo(User::class, 'collector_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_has_products', 'order_id', 'product_id')->withPivot('qty');
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    // public function orderhasstatus()
    // {
    //     return $this->hasMany(OrderHasStatus::class);
    // }

    public function stakeholders()
    {   
        return $this->belongsToMany(Client::class,'order_has_statuses','order_id','client_id')->withPivot('status_id', 'user_id' , 'created_at')->orderBy('order_has_statuses.id', 'ASC');
    }
    
    public function getLastStatusAttribute()
    {
        return $this->belongsToMany(Status::class, 'order_has_statuses', 'order_id', 'status_id')->withPivot('status_id', 'created_at')->orderBy('order_has_statuses.id', 'DESC')->limit(1)->get();
    }
    
    public function laststatus()
    {
        return $this->belongsToMany(Status::class, 'order_has_status', 'order_id', 'status_id')->withPivot('user_id', 'created_at')->orderBy('order_has_status.id', 'DESC')->limit(1);
    }
}
