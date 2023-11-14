<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Rules\NumberRule;
use App\Models\Appointment;
use Illuminate\Http\Request;
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
        $pendings = DB::table('appointmentpendingview')->get();

        return view('accounts.admin.pendings', [
            'pendings' => $pendings
        ]);
    }

    public function confirmed() {
        $confirmedAppointments = DB::table('appointmentconfirmedview')->get();
        $employee = fn($position) => Employee::where(['position' => $position, 'status' => 'employed'])->get();
    
        return view('accounts.admin.confirmed', [
            'appointments' => $confirmedAppointments,
            'employee' => $employee
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

    public function assign_employee() {

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

            $account = User::create([
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
