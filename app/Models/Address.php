<?php

namespace App\Models;
use App\Models\City;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;


class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'lat',
        'lng',
        'client_id',
        'street_name',
        'house_number',
        'building_name',
        'floor_door_number',
        'code_postal',
        'city',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function order()
    {
        return $this->HasMany(Order::class);
    }

}
