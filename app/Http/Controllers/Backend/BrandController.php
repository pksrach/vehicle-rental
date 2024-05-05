<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $req)
    {
        if ($req->ajax()) {
            $dataTableList = Brand::orderBy('id', 'desc')->get();
            return DataTables::of($dataTableList)
                ->addIndexColumn()
                ->addColumn('attachment', function ($row) {
                    $url = asset($row->attachment ? '/uploads/thumbnail/' . $row->attachment : 'no_img.jpg');
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('name', function ($row) {
                    return $row->name ? $row->name : 'N/A';
                })
                ->addColumn('description', function ($row) {
                    return $row->description ? $row->description : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '<button type="button" data-id="' . $row->id . '" class="editRoom btn btn-primary btn-sm">Edit</button>&nbsp;
                    <button type="button" id="' . $row->id . '" class="deleteRoom btn btn-danger btn-sm">Delete</button>';
                })
                ->rawColumns(['attachment', 'action'])
                ->make(true);
        }

        return view('backend.brand.index');
    }

    public function create(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'description' => 'required',
            'attachment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $req->name;
        $brand->description = $req->description;
        $brand->attachment = $req->attachment->getClientOriginalName();
        $brand->save();

        $req->attachment->move(public_path('uploads/thumbnail'), $req->attachment->getClientOriginalName());

        return response()->json(['success' => 'Data is successfully added']);
    }
}
