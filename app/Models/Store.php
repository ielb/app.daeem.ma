<?php

namespace App\Models;

#use http\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Hour;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Category;
use App\Models\Product;
use App\Models\Client;
use App\Models\StoreType;


class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_type_id',
        'name',
        'email',
        'password',
        'logo',
        'cover',
        'phone',
        'phone_two',
        'address',
        'city_id',
        'description',
        'commission',
        'radius',
        'lat',
        'lng',
        'use_fake_rating',
        'status',
        'recovery_token',
    ];

    public function storetype()
    {
        return $this->belongsTo(StoreType::class);
    }

    public function city(){

        return $this->belongsTo(City::class);

    }

    public function hours(){

        return $this->hasOne(Hour::class);

    }

    public function ratings(){

        return $this->hasMany(Rating::class);

    }

    public function orders(){

        return $this->hasOne(Order::class);

    }

    public function categories(){

        return $this->hasMany(Category::class);

    }

    public function products(){

        return $this->hasMany(Product::class);
    }



}
