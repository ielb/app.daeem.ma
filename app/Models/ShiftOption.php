<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Day;
use App\Models\Shift;


class ShiftOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_id',
        'day_id',
        'shift',
    ];

    public function day(){
        return $this->belongsTo(Day::class);
    }

    public function shift(){
        return $this->belongsTo(Shift::class);
    }
}
