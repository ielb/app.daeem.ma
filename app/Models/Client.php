<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Store;



class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'fb_id',
        'go_id',
        'status',
        'remember_token',
        'email_verified_at',
        'phone_verified_at',
        'client_token'
    ];

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

  
}
