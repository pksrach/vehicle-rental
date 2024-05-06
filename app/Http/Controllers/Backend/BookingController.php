<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booked;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $req)
    {
        $paymentMethods = PaymentMethod::all();

        if ($req->ajax()) {
            $dataTableList = Booked::with('booked_details')->orderBy('id', 'desc')->get();

            return DataTables::of($dataTableList)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {

                    $statusClass = match ($row->status) {
                        'pending' => 'warning',
                        'in progress' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    };

                    return '<span class="badge rounded-pill bg-' . $statusClass . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('amount', function ($row) {
                    return $row->amount ? '$' . number_format($row->amount, 2) : 'N/A';
                })
                ->addColumn('pickup_date', function ($row) {
                    return $row->pickup_date ? $row->pickup_date : 'N/A';
                })
                ->addColumn('complete_date', function ($row) {
                    return $row->complete_date ? $row->complete_date : 'N/A';
                })
                ->addColumn('customer', function ($row) {
                    return $row->customer->displayName() ? $row->customer->displayName() : 'N/A';
                })
                ->addColumn('staff', function ($row) {
                    return $row->staff->displayName() ? $row->staff->displayName() : 'N/A';
                })
                ->addColumn('payment_method', function ($row) {
                    return $row->paymentMethod->displayName() ? $row->paymentMethod->displayName() : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $button = '';

                    if ($row->status == 'pending') {
                        $button .= '<a href="' . route('backend.bookings.in-progress', $row->id) . '" class="btn btn-primary btn-sm">In Progress</a>';
                        $button .= '<a href="' . route('backend.bookings.cancel', $row->id) . '" class="btn btn-danger btn-sm">Cancel</a>';
                    } elseif ($row->status == 'in progress') {
                        $button .= '<a href="' . route('backend.bookings.complete', $row->id) . '" class="btn btn-success btn-sm">Complete</a>';
                    }

                    return $button;
                })
                ->addColumn('booked_details', function ($row) {
                    $details = $row->booked_details;
                    $output = '<table class="table table-borderless">';
                    if ($details) {
                        $output .= '<thead>';
                        $output .= '<tr>';
                        $output .= '<th>#</th>';
                        $output .= '<th>Vehicle</th>';
                        $output .= '<th>Vehicle Name</th>';
                        $output .= '<th>Brand</th>';
                        $output .= '<th>Category</th>';
                        $output .= '<th>Location</th>';
                        $output .= '<th>Service Price</th>';
                        $output .= '<th>Discount</th>';
                        $output .= '<th>Amount After Discount</th>';
                        $output .= '</tr>';
                        $output .= '</thead>';
                        $output .= '<tbody>';
                        foreach ($details as $detail) {
                            $vehicle = $detail->vehicle;
                            $amountAfterDiscount = $detail->service_price - ($detail->service_price * ($detail->discount / 100));
                            $output .= '<tr>';
                            $output .= '<td><img src="' . asset($vehicle->attachment ? '/uploads/thumbnail/' . $vehicle->attachment : 'no_img.jpg') . '" alt="Vehicle Attachment" width="100"></td>';
                            $output .= '<td>' . $vehicle->name . '</td>';
                            $output .= '<td>' . $vehicle->name . '</td>';
                            $output .= '<td>' . $vehicle->brand->name . '</td>';
                            $output .= '<td>' . $vehicle->category->name . '</td>';
                            $output .= '<td>' . $vehicle->location->name . '</td>';
                            $output .= '<td>' . $detail->service_price . '</td>';
                            $output .= '<td>' . $detail->discount . '</td>';
                            $output .= '<td>' . $amountAfterDiscount . '</td>';
                            $output .= '</tr>';
                        }
                        $output .= '</tbody>';
                    }

                    $output .= '</table>';

                    return $output;
                })
                ->rawColumns(['action', 'status', 'booked_details'])
                ->make(true);
        }

        return view('backend.booking.index');
    }
}
