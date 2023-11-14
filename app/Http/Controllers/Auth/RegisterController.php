<?php

namespace App\Http\Controllers\Auth;

use App\Models\Car;
use App\Models\User;
use App\Rules\NumberRule;
use Illuminate\Http\Request; 
use App\Rules\PlateNumberRule;
use Illuminate\Validation\Rules; 
use App\Rules\LowercaseLetterRule;
use App\Rules\UppercaseLetterRule;
use App\Rules\SpecialCharacterRule;
use App\Http\Controllers\Controller;
use App\Rules\PhoneNumberLenghtRule;
use App\Rules\UniquePlateNumberRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;  

class RegisterController extends Controller
{
    public function index() {
        return view("register");
    }

    public function customerRegister(Request $req) {
        $req->validate([
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', new PhoneNumberLenghtRule], 
            'email' => ['required', 'string', 'email', 'max:50', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:8',
                new UppercaseLetterRule, new LowercaseLetterRule, new NumberRule,
                new SpecialCharacterRule
            ],  
            'platenumber' => ['required', new UniquePlateNumberRule, new PlateNumberRule],
            'brand' => 'required',
            'model' => 'required',
            'color' => 'required',
            'cartype' => 'required', 
            'fueltype' => 'required',
            'transmission' => 'required'
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'password' => Hash::make($req->password),
        ]);

        Car::create([
            'user_id' => $user->id,
            'plate_number' => $req->platenumber,
            'brand' => $req->brand,
            'model' => $req->model,
            'car_type' => $req->cartype,
            'fuel_type' => $req->fueltype,
            'color' => $req->color,
            'transmission_type' => $req->transmission,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::CUSTOMER);
    }

    public function register(Request $request)
    {  
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::CUSTOMER);
    }
}
