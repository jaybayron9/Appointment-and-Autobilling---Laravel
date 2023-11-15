<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Service; 
use App\Models\Estimator;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class EmployeeController extends Controller
{
    public function index() {
        return view('accounts.employee.dashboard');
    }

    public function job_order() {
        $appointments = DB::table('appointment_employee_assign_view')->get();
        $services = Service::all();  

        return view('accounts.employee.joborder', [
            'appointments' => $appointments,
            'services' => $services
        ]);
    }

    public function history() {
        $histories = DB::table('appointment_history_view')->get();

        return view('accounts.employee.history', [
            'histories' => $histories
        ]);
    }

    public function estimator() {
        $select_tab = function($service) {
            return (isset($_GET['serv']) && $_GET['serv'] == $service) 
                    ? 'true' 
                    : 'false'; 
        };

        $appointment_details = function($column) { 
            $appointment = DB::select('CALL get_appointment_details(?, ?, ?)', [
                $_GET['app_id'] ?? 0,
                $_GET['user_id'] ?? 0,
                $_GET['car_id'] ?? 0 
            ]); 

            foreach ($appointment as $app)
                return $app->$column;
        };   

        $estimators = function ($service, $car_type = null) {
            $query = Estimator::select('*')->where('service', $service);
        
            if ($car_type !== null)
                $query->where('car_type', $car_type); 

            return $query->get();
        };

        return view('accounts.employee.estimator', [
            'select_tab' => $select_tab,
            'appointment_details' => $appointment_details,
            'estimators' => $estimators
        ]);
    }

    public function update_appointment_status(Request $req) {
        try {
            Appointment::where('id', $req->id)->update([
                'appointment_status' => $req->status
            ]);

            if ($req->status === 'Underway') 
                Payment::create([
                    'appointment_id' => $req->id
                ]);

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'status' => 400
            ]);
        }
    }
}
