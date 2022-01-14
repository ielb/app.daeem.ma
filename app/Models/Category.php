<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
use App\Models\Subcategory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'name',
        'image',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function subcategories(){

        return $this->hasMany(Subcategory::class);
    }
}
