<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Store;


class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'supermarket_id',
        'rating',
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

}
