<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walkin extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'name',
        'email',
        'phone',
        'address',
        'plate_no',
        'service_id',
        'brand',
        'model',
        'schedule_date',
        'service_time_id',
        'appointment_status',
        'payment_status',
    ];
}
