<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $req)
    {
        $locations = Location::orderBy('id', 'desc')->get();
        if ($req->ajax()) {
            $dataTableList = $locations;
            return DataTables::of($dataTableList)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name ? $row->name : 'N/A';
                })
                ->addColumn('parent_name', function ($row) {
                    return $row->parent ? $row->parent->name : ''; // Check if parent exists before accessing its name
                })
                ->addColumn('parent_id', function ($row) {
                    return $row->parent ? $row->parent->id : ''; // This is the id
                })
                ->addColumn('action', function ($row) {
                    return '<button type="button" data-id="' . $row->id . '" class="editRoom btn btn-primary btn-sm">Edit</button>&nbsp;
                    <button type="button" id="' . $row->id . '" class="deleteRoom btn btn-danger btn-sm">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.location.index', compact('locations'));
    }

    public function create(Request $req)
    {
        $req->validate([
            'name' => 'required',
        ]);

        $brand = new Location();
        $brand->name = $req->name;
        $brand->parent_id = $req->parent_id;
        $brand->save();

        return response()->json(['success' => 'Data is successfully added']);
    }
}
