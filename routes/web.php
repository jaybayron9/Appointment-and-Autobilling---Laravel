<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;    
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentSlipController;

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/show_service_package/{id}', [WelcomeController::class, 'show_package']);

Route::middleware('guest')->group(function (){
    Route::get('/login', [Auth\LoginController::class, 'index'])->name('login');
    Route::post('/login', [Auth\LoginController::class, 'login']);
    
    Route::get('/register', [Auth\RegisterController::class, 'index'])->name('register');
    Route::post('/register', [Auth\RegisterController::class, 'customerRegister']);
});

Route::post('/logout', [Auth\LoginController::class, 'logout'])->name('logout.account')->middleware('auth');

Route::middleware(['auth', 'admin'])->controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.dashboard');
    Route::get('/admin/pendings', 'pendings')->name('admin.pendings');
    Route::get('/admin/confirmed', 'confirmed')->name('admin.confirmed');
    Route::get('/admin/employees', 'employees')->name('admin.employees');
    Route::get('/admin/walkin', 'walkin')->name('admin.walkin');
    Route::get('/admin/transactions', 'transactions')->name('admin.transactions');
    Route::get('/admin/history', 'history')->name('admin.history');
    
    Route::post('/admin/update_appointment_status', 'update_appointment_status');
    Route::post('/admin/add_employee', 'add_employee');
    Route::post('/admin/assign_employee', 'assign_employee');
    Route::post('/admin/cancel_appointment/{id}', 'cancel_appointment'); 
    Route::post('/admin/update_payment_status', 'update_payment_status');
    Route::post('/admin/get_total_sales', 'get_total_sales');
    Route::post('/admin/add_walkin', 'add_walkin');
    Route::post('/admin/cancel_walkin', 'cancel_walkin');
    Route::get('/admin/get_unpaid_walkins', 'show_unpaid_walkins');
    Route::post('/admin/add_walkin_payment', 'add_walkin_payment');
});

Route::middleware(['auth', 'employee'])->controller(EmployeeController::class)->group(function () {
    Route::get('/employee', 'index')->name('employee.dashboard');
    Route::get('/employee/job_order', 'job_order')->name('employee.job_order');
    Route::get('/employee/history', 'history')->name('employee.history');
    Route::get('/employee/estimator', 'estimator')->name('employee.estimator');

    Route::post('/employee/update_appointment_status', 'update_appointment_status');
});

Route::middleware(['auth', 'customer'])->controller(CustomerController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard'); 
    Route::get('/appointments', 'appointments')->name('appointments');
    Route::get('/status', 'status')->name('status');
    Route::get('/cars', 'cars')->name('cars');
    Route::get('/history', 'history')->name('history');
    Route::get('/profile', 'profile')->name('profile');

    Route::post('/book_appointment', 'book_appointment');
    Route::post('/cancel_appointment/{id}', 'cancel_appointment'); 
    Route::post('/add_car', 'add_car');
    Route::get('/get_car/{id}', 'get_car');
    Route::post('/update_car', 'update_car');
    Route::get('/delete_car/{id}', 'delete_car'); 
}); 

Route::middleware('auth')->controller(PaymentSlipController::class)->group(function() {
    Route::post('/save_payment_slip', 'save_payment_slip');
    Route::post('/show_payment_slip', 'show_payment_slip');
    Route::post('/set_session_print', 'set_session_print');
});