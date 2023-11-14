<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller {

    public function index() {
        return view('login');
    }

    public function login(LoginRequest $request) {
        $request->authenticate();

        $request->session()->regenerate();  

        switch (auth()->user()->role) {
            case 'admin':
                return redirect()->intended(RouteServiceProvider::ADMIN);
            case 'employee':
                return redirect()->intended(RouteServiceProvider::EMPLOYEE);
            case 'customer':
                return redirect()->intended(RouteServiceProvider::CUSTOMER);
            default:
                return redirect()->route('login');
        }
    } 

    public function logout(Request $request) {  
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); 
    }
}
