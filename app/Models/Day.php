<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shift;


class Day extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'number',
    ];

    public function shifts(){
        return $this->HasMany(Shift::class);
    }
}
