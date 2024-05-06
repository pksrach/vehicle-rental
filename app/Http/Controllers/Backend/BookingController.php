<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booked;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $req)
    {
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
                        $button .= '<button data-url="' . route('backend.bookings.in-progress', $row->id) . '" data-action="In Progress" class="btn btn-primary btn-sm action-button" data-bs-toggle="modal" data-bs-target="#confirmModal">In Progress</button> ';
                        $button .= '<button data-url="' . route('backend.bookings.cancel', $row->id) . '" data-action="Cancel" class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#confirmModal">Cancel</button> ';
                    } elseif ($row->status == 'in progress') {
                        $button .= '<button data-url="' . route('backend.bookings.complete', $row->id) . '" data-action="Complete" class="btn btn-success btn-sm action-button" data-bs-toggle="modal" data-bs-target="#confirmModal">Complete</button> ';
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
                            $output .= '<td>' . '$' . $detail->service_price . '</td>';
                            $output .= '<td>' . $detail->discount . '%' . '</td>';
                            $output .= '<td>' . '$' . $amountAfterDiscount . '</td>';
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


    public function inProgress($id): \Illuminate\Http\JsonResponse
    {
        // Fetch the booking with the given id
        $booking = Booked::findOrFail($id);

        // Check if the status is 'pending'
        if ($booking->status !== 'pending') {
            // Redirect back with an error message
            return response()->json(['error' => 'Booking status is not pending.'], 400);
        }

        // Update the status to 'in progress'
        $booking->status = 'in progress';

        try {
            $booking->save();
            // Redirect back with a success message
            return response()->json(['success' => 'Booking status updated to in progress.'], 200);
        } catch (\Exception $e) {
            // Redirect back with an error message
            return response()->json(['error' => 'Failed to update booking status.'], 500);
        }
    }

    // Complete booking
    public function complete($id): \Illuminate\Http\JsonResponse
    {
        // Fetch the booking with the given id
        $booking = Booked::findOrFail($id);

        // Check if the status is 'pending'
        if ($booking->status !== 'in progress') {
            // Redirect back with an error message
            return response()->json(['error' => 'Booking status is not pending.'], 400);
        }

        // Update the status to 'in progress'
        $booking->status = 'completed';

        try {
            $booking->save();
            // Redirect back with a success message
            return response()->json(['success' => 'Booking has completed'], 200);
        } catch (\Exception $e) {
            // Redirect back with an error message
            return response()->json(['error' => 'Failed to update booking status.'], 500);
        }
    }

    // Cancel
    public function cancel($id): \Illuminate\Http\JsonResponse
    {
        // Fetch the booking with the given id
        $booking = Booked::findOrFail($id);

        // Check if the status is 'pending'
        if ($booking->status !== 'pending') {
            // Redirect back with an error message
            return response()->json(['error' => 'Booking status is not pending.'], 400);
        }

        // Update the status to 'in progress'
        $booking->status = 'cancelled';

        try {
            $booking->save();
            // Redirect back with a success message
            return response()->json(['success' => 'Booking has cancelled'], 200);
        } catch (\Exception $e) {
            // Redirect back with an error message
            return response()->json(['error' => 'Failed to update booking status.'], 500);
        }
    }
}
