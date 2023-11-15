<?php

namespace App\Http\Controllers;

use App\Models\Estimator;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $estimators = Estimator::all();

        return view('welcome', [
            'estimators' => $estimators
        ]);
    }

    public function show_package($id) {
        try {
            $estimator = Estimator::where('id', $id)->get(); 
            $inclusions = array_filter(explode(',', $estimator[0]['inclusions']));

            return response()->json([
                'estimator' => $estimator, 
                'inclusions' => $inclusions]); 
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }
}
