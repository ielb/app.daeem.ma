<?php

namespace App\Models;

use App\Models\Shift;
use App\Models\ShiftOption;
use App\Models\User;
use App\Models\Day;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverShift extends Model
{
    use HasFactory;
    protected $fillable = [
        'shift_id',
        'shift_option_id',
        'zone_id',
        'user_id',
        'day_id',
        'week',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shift(){
        return $this->belongsTo(Shift::class);
    }

    public function shift_option(){
        return $this->belongsTo(ShiftOption::class);
    }

    public function day(){
        return $this->belongsTo(Day::class);
    }
}
