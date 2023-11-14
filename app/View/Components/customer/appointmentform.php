<?php

namespace App\View\Components\customer;

use App\Models\bussiness_hour;
use Closure;
use App\Models\Car;
use App\Models\Service;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class appointmentform extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {  
        return view('components.customer.appointmentform', [
            'cars' =>Car::where('user_id', Auth::user()->id)
                        ->get(),
            'services' => Service::all(),
            'bussiness_hours' => bussiness_hour::all()
        ]);
    }
}
