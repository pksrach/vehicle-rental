<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Location;
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
        $brands = Brand::all();
        $categories = Category::all();
        $locations = Location::all();

        if ($req->ajax()) {
            $dataTableList = Vehicle::with(['brand', 'category', 'location']) // eager load the relationships
            ->orderBy('name')->get();

            return DataTables::of($dataTableList)
                ->addIndexColumn()
                ->addColumn('attachment', function ($row) {
                    $url = asset($row->attachment ? '/uploads/thumbnail/' . $row->attachment : 'uploads/no_img.jpg');
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->addColumn('price', function ($row) {
                    return $row->price;
                })
                ->addColumn('brand', function ($row) {
                    return $row->brand->name;
                })
                ->addColumn('category', function ($row) { // add category column
                    return $row->category->name;
                })
                ->addColumn('location', function ($row) { // add location column
                    return $row->location->name;
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
                ->rawColumns(['is_active', 'action', 'attachment'])
                ->make(true);
        }

        return view('backend.vehicle.index', compact('brands', 'categories', 'locations'));
    }


}
