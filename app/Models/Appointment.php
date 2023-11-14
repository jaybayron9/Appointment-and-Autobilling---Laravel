<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'book_summary_id',
        'assigned_employee_id',
        'service_type_id',
        'note',
        'schedule_date',
        'service_time_id',
        'appointment_status',
        'payment_status',
    ];
}
