<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;

class StoreType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public function stores()
    {
        return $this->HasMany(Store::class);
    }
}
