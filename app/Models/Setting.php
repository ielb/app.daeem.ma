<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name',
        'site_logo',
        'description',
        'facebook_link',
        'instagram_link',
        'playstore',
        'appstore',
        'maps_api_key',
    ];
}
