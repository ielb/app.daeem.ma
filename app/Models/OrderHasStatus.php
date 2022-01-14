<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Store;
use App\Models\Status;

class OrderHasStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'status_id',
        'client_id',
        'user_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function orders()
    {
        return $this->hasMany(order::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    

}
