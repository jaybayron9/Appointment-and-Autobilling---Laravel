<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimator extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_type',
        'service',
        'name',
        'price',
        'inclusions',
        'img',
        'quantity'
    ];
}
