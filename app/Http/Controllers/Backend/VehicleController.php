<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $req)
    {
        if ($req->ajax()) {
            $dataTableList = Vehicle::orderBy('name', 'asc')->get();

            return DataTables::of($dataTableList)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->addColumn('price', function ($row) {
                    return $row->price;
                })
                ->addColumn('attachment', function ($row) {
                    return $row->attachment;
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
                    return '<button type="button" id="' . $row->id . '" class="editRoom btn btn-primary btn-sm">Edit</button>&nbsp;
                        <button type="button" id="' . $row->id . '" class="deleteRoom btn btn-danger btn-sm">Delete</button>';
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }

        return view('backend.vehicle.index');
    }
}
