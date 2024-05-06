<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $req)
    {
        if ($req->ajax()) {
            $dataTableList = Customer::orderBy('id', 'desc')->get();
            return DataTables::of($dataTableList)
                ->addIndexColumn()
                ->addColumn('attachment', function ($row) {
                    $url = asset($row->attachment ? '/uploads/thumbnail/' . $row->attachment : 'no_person.png');
                    return '<img src="' . $url . '" border="0" width="60" class="img-rounded" align="center" />';
                })
                ->addColumn('first_name', function ($row) {
                    return $row->first_name ? $row->first_name : 'N/A';
                })
                ->addColumn('last_name', function ($row) {
                    return $row->last_name ? $row->last_name : 'N/A';
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone ? $row->phone : 'N/A';
                })
                ->addColumn('card_identify', function ($row) {
                    return $row->card_identify ? $row->card_identify : 'N/A';
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
                    return '
                        <button type="button" data-id="' . $row->id . '" class="editRoom btn btn-primary btn-sm">Edit</button>&nbsp;
                        <button type="button" id="' . $row->id . '" class="deleteRoom
                        btn btn-danger btn-sm">Delete</button>
                    ';
                })
                ->rawColumns(['attachment', 'is_active', 'action'])
                ->make(true);
        }

        return view('backend.customer.index');
    }
}
