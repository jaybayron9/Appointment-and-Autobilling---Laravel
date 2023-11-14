<?php

use Illuminate\Support\Facades\Route;    
use App\Http\Controllers\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;

Route::get('/', [WelcomeController::class, 'index']); 

Route::middleware('guest')->group(function (){
    Route::get('/login', [Auth\LoginController::class, 'index'])->name('login');
    Route::post('/login', [Auth\LoginController::class, 'login']);
    
    Route::get('/register', [Auth\RegisterController::class, 'index']);
    Route::post('/register', [Auth\RegisterController::class, 'customerRegister']);
});

Route::post('/logout', [Auth\LoginController::class, 'logout'])->name('logout.account')->middleware('auth');

Route::middleware(['auth', 'admin'])->controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.dashboard');
    Route::get('/admin/pendings', 'pendings')->name('admin.pendings');
    Route::get('/admin/confirmed', 'confirmed')->name('admin.confirmed');
    Route::get('/admin/employees', 'employees')->name('admin.employees');
    
    Route::post('/admin/update_appointment_status', 'update_appointment_status');
    Route::post('/admin/add_employee', 'add_employee');
    Route::post('/admin/assign_employee', 'assign_employee');
    Route::post('/admin/cancel_appointment/{id}', 'cancel_appointment');
});

Route::middleware(['auth', 'employee'])->controller(EmployeeController::class)->group(function () {
    Route::get('/employee', 'index')->name('employee.dashboard');
    ROute::get('/employee/job_order', 'job_order')->name('employee.job_order');
});

Route::middleware(['auth', 'customer'])->controller(CustomerController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard'); 
    Route::get('/appointments', 'appointments')->name('appointments');
    Route::get('/status', 'status')->name('status');
    Route::get('/cars', 'cars')->name('cars');
    Route::get('/history', 'history')->name('history');
    Route::get('/profile', 'profile')->name('profile');

    // CRUD Appointment
    Route::post('/book_appointment', 'book_appointment');
    Route::post('/cancel_appointment/{id}', 'cancel_appointment');
    // CRUD Car
    Route::post('/add_car', 'add_car');
    Route::get('/get_car/{id}', 'get_car');
    Route::post('/update_car', 'update_car');
    Route::get('/delete_car/{id}', 'delete_car'); 
}); 