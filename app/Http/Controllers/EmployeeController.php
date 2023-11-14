<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        return view('accounts.employee.dashboard');
    }

    public function job_order() {
        return view('accounts.employee.joborder');
    }
}
