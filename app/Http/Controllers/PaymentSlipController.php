<?php

namespace App\Http\Controllers;

session_start();

use App\Models\Payment;
use Illuminate\Http\Request; 
use App\Models\BookingSummary;
use Illuminate\Support\Facades\DB;

class PaymentSlipController extends Controller
{
    public string $products; 
    public string $price;
    public function save_payment_slip(Request $req) {
        try {
            $products = ''; $price = '';
            for ($i=0; $i < count($req->data); $i++) {
                $filterdPrice = str_replace([',', '₱'], '', $req->data[$i]['price']);
                $products .= $req->data[$i]['product'].'~';
                $price .= (int)$filterdPrice.'~'; 
            }

            BookingSummary::where('appointment_id', $req->app_id)->update([
                'products' => $products,
                'quantity' => $req->total_items,
                'price' => $price,
                'total' => str_replace([',', '₱'], '', $req->total)
            ]); 
    
            Payment::where('appointment_id', $req->app_id)->update([
                'total_due' => str_replace([',', '₱'], '', $req->total)
            ]); 
    
            self::book_session($req->data, $req->total_items, $req->total, $req); 
    
            return response()->json(['status' => 200]); 
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message'=> $e->getMessage()
            ]);
        }
    }

    // public function show_book_summary() {
    //     $qry = DBConn::DBQuery("SELECT ap.id AS app_id, ap.*, cl.*, cs.*, sv.*, bh.*, bs.*
    //             FROM appointments ap
    //             JOIN users cl ON cl.id = ap.user_id
    //             JOIN cars cs ON cs.id = ap.car_id
    //             JOIN services sv ON sv.id = ap.service_type_id
    //             JOIN bussiness_hours bh ON bh.id = ap.service_time_id
    //             JOIN booking_summary bs ON bs.id = ap.book_summary_id
    //         WHERE 
    //             ap.id = '{$_POST['appointment_id']}'
    //     "); 
    //     return json_encode($qry);
    // }

    public static function book_session($data, $items, $total, $req) {
        $slips = DB::select('CALL payment_slip(?, ?, ?)', [
            $req->app_id,
            $req->user_id,
            $req->car_id
        ]);

        foreach ($slips as $slip) {
            $_SESSION['book_name'] = isset($slip->name) != '' ? $slip->name : '-';
            $_SESSION['book_email'] = isset($slip->email) != '' ? $slip->email : '-';
            $_SESSION['book_phone'] = isset($slip->phone) != '' ? $slip->phone : '-';
            $_SESSION['book_brand'] = isset($slip->brand) != '' ? $slip->brand : '-';
            $_SESSION['book_model'] = isset($slip->model) != '' ? $slip->model : '-';
            $_SESSION['book_pms'] = isset($slip->pms) != '' ? $slip->pms : '-';
            $_SESSION['book_schedule_date'] = isset($slip->schedule_date) != '' ? $slip->schedule_date : '-'; 
            $_SESSION['book_service_time'] = isset($slip->available_time) != '' ? $slip->available_time : '-'; 
        }

        $_SESSION['book_data'] = $data;
        $_SESSION['book_total_items'] = $items;
        $_SESSION['book_total'] = $total;
    }

    public function show_payment_slip(Request $req) {
        try {
            $showPaymentSlip = DB::select('Call show_payment_slip(?)', [
                $req->appointment_id
            ]);

            return response()->json($showPaymentSlip);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message'=> $e->getMessage()
            ]);
        }
    }

    public function set_session_print(Request $req) {
        $this->book_session($req->data, $req->total_items, $req->total, $req); 
    }
}
