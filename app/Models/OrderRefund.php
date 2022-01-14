<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class OrderRefund extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'client_id',
        'reason',
    ];


    public function client(){

        return $this->belongsTo(Client::class);
    }

    public function order(){

        return $this->belongsTo(Order::class);
    }
}
