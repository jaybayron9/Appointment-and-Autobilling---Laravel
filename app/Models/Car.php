<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "plate_number",
        "brand",
        "model",
        "car_type",
        "fuel_type",
        "color",
        "transmission_type"
    ];
}
