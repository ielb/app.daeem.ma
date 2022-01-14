<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderHasStatus;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'alias',
        'color',
    ];


    public function orderhasstatus()
    {
        return $this->belongsTo(OrderHasStatus::class);
    }

}
