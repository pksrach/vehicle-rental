<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentMethodController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $req)
    {
        if ($req->ajax()) {
            $dataTableList = PaymentMethod::orderBy('id', 'desc')->get();

            return DataTables::of($dataTableList)
                ->addIndexColumn()
                ->addColumn('payment_name', function ($row) {
                    return $row->payment_name ? $row->payment_name : 'N/A';
                })
                ->addColumn('account_name', function ($row) {
                    return $row->account_name ? $row->account_name : 'N/A';
                })
                ->addColumn('account_number', function ($row) {
                    return $row->account_number ? $row->account_number : 'N/A';
                })
                ->addColumn('links', function ($row) {
                    return $row->links ? $row->links : 'N/A';
                })
                ->addColumn('is_active', function ($row) {
                    $checked = $row->is_active ? 'checked' : '';
                    return '
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked' . $row->id . '" ' . $checked . '>
                            </div>
                        </td>
                    ';
                })
                ->addColumn('action', function ($row) {
                    return '<button type="button" data-id="' . $row->id . '" class="editRoom btn btn-primary btn-sm">Edit</button>&nbsp;
                    <button type="button" id="' . $row->id . '" class="deleteRoom btn btn-danger btn-sm">Delete</button>';
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }

        return view('backend.payment_method.index');
    }

    public function create(Request $req)
    {
        $req->validate([
            'payment_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'active' => 'required',
        ]);

        $paymentMethod = new PaymentMethod();
        $paymentMethod->payment_name = $req->payment_name;
        $paymentMethod->account_name = $req->account_name;
        $paymentMethod->account_number = $req->account_number;
        $paymentMethod->links = $req->links;
        $paymentMethod->is_active = $req->active;

        try {
            $paymentMethod->save();
            return response()->json(['success' => 'Payment Method created successfully.']);
        } catch (\Exception $e) {
            // Return the error message as JSON
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
