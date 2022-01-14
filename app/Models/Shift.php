<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Day;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'week',
        'day_id',
        'zone_id',
    ];

    public function day(){
        return $this->belongsTo(Day::class);
    }

}
