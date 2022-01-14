<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    use HasFactory;
    protected $fillable = [
        '0_from',
        '0_to',
        '1_from',
        '1_to',
        '2_from',
        '2_to',
        '3_from',
        '3_to',
        '4_from',
        '4_to',
        '5_from',
        '5_to',
        '6_from',
        '6_to',
        'day_off',
        'store_id',
    ];
}
