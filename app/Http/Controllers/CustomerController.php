<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\BookingSummary;
use App\Rules\PlateNumberRule;
use Illuminate\Support\Facades\DB;
use App\Rules\UniquePlateNumberRule;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index() {
        return view("accounts.customer.dashboard");
    }

    public function appointments() {  
        $appoinments = DB::select("CALL GetCustomerAppointments(?)", [
            Auth::user()->id
        ]);

        return view("accounts.customer.appointments", [
            'appointments' => $appoinments
        ]);
    }

    public function status() {
        return view("accounts.customer.status");
    }

    public function history() {
        return view("accounts.customer.history");
    }

    public function cars() {
        $cars = Car::where('user_id', Auth::user()->id);

        return view("accounts.customer.cars", [
            'cars' => $cars->get()
        ]);
    }

    public function profile() {
        return view("accounts.customer.profile");
    }

    public function book_appointment(Request $req) {
        try {
            $appointment = Appointment::create([
                'user_id' => Auth::user()->id,
                'car_id' => $req->car_id,
                'service_type_id' => $req->service, 
                'schedule_date' => $req->schedule_date,
                'service_time_id' => $req->time
            ]);

            BookingSummary::create([
                'user_id' => Auth::user()->id,
                'car_id' => $req->car_id,
                'appointment_id' => $appointment->id
            ]); 
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(), 
                'line' => $e->getLine()]
            );
        }
    }

    public function cancel_appointment($id) {
        try {
            Appointment::find($id)->update([
                'appointment_status' => 'Cancelled'
            ]);  
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(), 
                'line' => $e->getLine()]
            );
        }
    }

    public static function car_validator($req) {
        return Validator::make($req, [ 
            'plate_number' => ['required', new PlateNumberRule, new UniquePlateNumberRule],
            'brand' => ['required'],
            'model' => ['required'],
            'car_type' => ['required'],
            'fuel_type' => ['required'],
            'color' => ['required'],
            'transmission_type' => ['required'],
        ]);
    }

    public function add_car(Request $req) {
        try {
            $validator = CustomerController::car_validator($req->all());

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                    'status' => 400
                ]);
            }

            Car::create([
                'user_id' => Auth::user()->id,
                'plate_number' => $req->plate_number,
                'brand' => $req->brand,
                'model' => $req->model,
                'car_type' => $req->car_type,
                'fuel_type' => $req->fuel_type,
                'color' => $req->color,
                'transmission_type' => $req->transmission_type,
            ]); 

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(), 
                'line' => $e->getLine()]
            );
        }
    }

    public function get_car($id) {
        try {
            $car = Car::where('id', $id)->limit(1)->get(); 

            return response()->json($car);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(), 
                'line' => $e->getLine()]
            );
        }
    }

    public function update_car(Request $req) {
        try {
            $car = Car::where('id', $req->car_id)->update([ 
                'brand' => $req->brand,
                'model' => $req->model,
                'car_type' => $req->car_type,
                'fuel_type' => $req->fuel_type,
                'color' => $req->color,
                'transmission_type' => $req->transmission_type,
            ]);

            return response()->json(['status' => 200, 'message' => 'There\'s a problem updating your car.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(), 
                'line' => $e->getLine()]
            );
        }
    }

    public function delete_car($id) {
        try {
            Car::where('id', $id)->delete();

            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(), 
                'line' => $e->getLine()]
            );
        }
    }
}
