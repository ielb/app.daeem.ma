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


class Supermarket extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'cover',
        'phone',
        'address',
        'city_id',
        'description',
        'lat',
        'lng',
        'use_fake_rating',
        'status',
    ];

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
