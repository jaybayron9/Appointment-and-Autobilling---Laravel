<?php

namespace App\Http\Controllers;

use App\Models\BookingSummary;
use App\Models\User;
use App\Models\Walkin;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Employee;
use App\Rules\NumberRule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\bussiness_hour;
use App\Rules\LowercaseLetterRule;
use App\Rules\UppercaseLetterRule;
use Illuminate\Support\Facades\DB;
use App\Rules\SpecialCharacterRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index() {
        return view('accounts.admin.dashboard');
    }

    public function pendings() {
        $pendings = DB::table('appointment_pending_view')->get();

        return view('accounts.admin.pendings', [
            'pendings' => $pendings
        ]);
    }

    public function confirmed() {
        $confirmedAppointments = DB::table('appointment_confirmed_view')->get();
        $employee = fn($position) 
                    => Employee::where([
                        'position' => $position, 
                        'status' => 'employed'
                    ])->get(); 

        return view('accounts.admin.confirmed', [
            'appointments' => $confirmedAppointments,
            'employee' => $employee
        ]);
    } 

    public function walkin() {
        $walkins = DB::table("walkins as wk")
                    ->leftJoin('services as sv', 'sv.id', '=', 'wk.service_id')
                    ->leftJoin('bussiness_hours as bh', 'bh.id', '=', 'wk.service_time_id')
                    ->select("wk.id", "wk.name", "wk.phone", "wk.address", "sv.category", "wk.plate_no", "wk.brand", "wk.model", "wk.schedule_date", "bh.available_time", "wk.payment_status")
                    ->get();
        $services = Service::all();
        $bussiness_hours = bussiness_hour::all();

        return view('accounts.admin.walkin', [
            'walkins' => $walkins,
            'services' => $services,
            'bussiness_hours' => $bussiness_hours
        ]);
    }

    public function transactions() {
        $transactions = DB::table('show_transations_view')->get();

        return view('accounts.admin.transaction', [
            'transactions' => $transactions
        ]);
    }

    public function history() {
        $histories = DB::table('appointment_history_view')->get();
        $walkins = DB::table('walkins as wk')
                    ->leftJoin('services as sv', 'sv.id', '=', 'wk.service_id')
                    ->leftJoin('bussiness_hours as bh', 'bh.id', '=', 'wk.service_time_id')
                    ->select("wk.schedule_date", "wk.plate_no", "sv.category", "wk.schedule_date", "bh.available_time", "wk.created_at as walkin_created_at")
                    ->where('payment_status', 'Paid')
                    ->get();

        return view('accounts.admin.history', [
            'histories' => $histories,
            'walkins' => $walkins
        ]);
    }

    public function employees() {
        $employees = Employee::all();

        return view('accounts.admin.employee', [
            'employees' => $employees
        ]);
    }

    public function update_appointment_status(Request $req) {
        try {
            Appointment::find($req->id)->update([
                'appointment_status' => $req->status
            ]);

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine() 
            ]);
        }
    }

    public function assign_employee(Request $req) {
        try {  
            Appointment::find($req->app_id)->update([
                'assigned_employee_id' => "{$req->mechanic}, {$req->electrician}"
            ]);

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine() 
            ]);
        }
    }

    public function cancel_appointment($id) {
        try {
            Appointment::find($id)->update([
                'appointment_status' => 'Cancelled'
            ]);  

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(), 
                'line' => $e->getLine()]
            );
        }
    }

    public function update_payment_status(Request $req) {
        try {
            Appointment::find($req->id)->update([
                'payment_status' => $req->status
            ]);

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine() 
            ]);
        }
    }

    public function get_total_sales(Request $req) {
        try {
            $total = DB::table('payments')
                        ->whereBetween("created_at", [
                                        $req->start_date ?? date('Y-m-d'),
                                        $req->end_date ?? date('Y-m-d')
                                    ]) 
                        ->select(DB::raw('SUM(total_due) as total_sale'))
                        ->get();

            return response()->json($total);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function add_walkin(Request $req) {
        try {
            Walkin::create([
                'name' => $req->name, 
                'phone' => $req->phone,
                'address' => $req->address,
                'plate_no' => $req->plate_no,
                'service_id' => $req->service,
                'brand' => $req->brand,
                'model' => $req->model,
                'schedule_date' => $req->schedule,
                'service_time_id' =>$req->time
            ]);

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function show_unpaid_walkins() {
        try {
            $walkin = Walkin::where('payment_status', 'Unpaid')->select('*')->get();

            return response()->json($walkin);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function add_walkin_payment(Request $req) {
        try {
            $data = explode(' | ', $req->name); 
            $id = count($data) == 3 ? true : false; 

            $walkin = Walkin::find($data[0])->get();

            Payment::create([
                'name' => $walkin[0]['name'],
                'email' => $walkin[0]['email'],
                'phone' => $walkin[0]['phone'],
                'description' => "(Walkin) $req->description",
                'total_due' => $req->amount
            ]);

            Walkin::find($data[0])->update([
                'payment_status' => 'Paid',
            ]);

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e->getMessage(),
                'line' => $e->getLine()
        ]);
    }
    }

    public function cancel_walkin(Request $req) {
        try {
            Walkin::find($req->id)->delete();

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function add_employee(Request $req) {
        try {
            $validator = Validator::make($req->all(), [
                'name' => ['required'],
                'phone' => ['required'],
                'email' => ['required', 'email', 'max:50', 'unique:'.User::class],
                'address' => ['required'],
                'nationality' => ['required'],
                'gender' => ['required'],
                'position' => ['required'], 
                'birth_date' => ['required'],
                'birth_place' => ['required'],
                'date_started' => ['required'],
                'password' => ['required', 'min:8',
                    new UppercaseLetterRule, new LowercaseLetterRule, new NumberRule,
                    new SpecialCharacterRule
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                    'status' => 400
                ]);
            }

            $employee = Employee::create([
                'name' => $req->name,
                'phone' => $req->phone,
                'email' => $req->email,
                'address' => $req->address,
                'nationality' => $req->nationality,
                'gender' => $req->gender,
                'position' => $req->position,
                'age' => $req->age,
                'birth_date' => $req->birth_date,
                'birth_place' => $req->birth_place,
                'date_started' => $req->date_started
            ]);

            User::create([
                'employee_id' => $employee->id,
                'name' => $req->name,
                'email' => $req->email,
                'phone' => $req->phone,
                'password' => Hash::make($req->password),
                'role' => 'employee'
            ]);

            return response()->json($req->all());
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine() 
            ]);
        }
    }
}
