<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'phone', 'email', 'address', 'nationality',
        'gender', 'position', 'birth_date', 'birth_place', 'date_started',
        'status', 'last_day'
    ];
}
