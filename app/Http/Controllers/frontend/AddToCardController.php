<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Booked;
use App\Models\BookedDetail;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class AddToCardController extends Controller
{
    // 
    public function index()
    {
        return view('frontend.booking.index');
    }
    public function postBooking(Request $request)
    {        try {
            $booked = new Booked();
            $booked_detail = new BookedDetail();
            $booked->customer_id = 10;
            $booked->total_price = 1000;
            $booked->status = 1;
            $booked_detail->booked_id = 10;
            $booked_detail->vehicle_id = 1;
            $booked_detail->price = 1000;
            $booked_detail->qty = 1;
            $booked_detail->total_price = 1000;
            $booked_detail->status = 0;
            $booked_detail->save();
            $booked->save();
            return redirect()->route('frontend.home');
        } catch (QueryException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
