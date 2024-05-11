<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Location;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
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
            ->orderBy('name', 'asc')->get();

            return DataTables::of($dataTableList)
                ->addIndexColumn()
                ->addColumn('attachment', function ($row) {
                    $url = asset($row->attachment ? '/uploads/thumbnail/' . $row->attachment : 'no_img.jpg');
                    return '<img src="' . $url . '" border="0" width="100" class="img-rounded" align="center" />';
                })
                ->addColumn('name', function ($row) {
                    return $row->name ? $row->name : 'N/A';
                })
                ->addColumn('description', function ($row) {
                    return $row->description ? $row->description : 'N/A';
                })
                ->addColumn('price', function ($row) {
                    return $row->price ? $row->price : 'N/A';
                })
                ->addColumn('brand', function ($row) {
                    return $row->brand ? $row->brand->name : 'N/A';
                })
                ->addColumn('category', function ($row) {
                    return $row->category ? $row->category->name : 'N/A';
                })
                ->addColumn('location', function ($row) {
                    return $row->location ? $row->location->name : 'N/A';
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
                ->rawColumns(['is_active', 'action', 'attachment'])
                ->make(true);
        }

        return view('backend.vehicle.index', compact('brands', 'categories', 'locations'));
    }

    public function create(Request $req): \Illuminate\Http\JsonResponse
    {
        // Check if Brand, category, and location == "" or null or empty just set it null
        $brand = $req->brand == "" ? null : $req->brand;
        $category = $req->category == "" ? null : $req->category;
        $location = $req->location == "" ? null : $req->location;

        // Check required name, active, and price
        $req->validate([
            'name' => 'required|unique:vehicles',
            'price' => 'required',
            'active' => 'required',
            'attachment' => 'file', // attachment is optional
        ], [
            'name.required' => 'Name is required',
            'name.unique' => 'Name must be unique',
            'price.required' => 'Price is required',
            'active.required' => 'Active is required',
        ]);

        // Start add request into db
        $vehicle = new Vehicle();
        $vehicle->name = $req->name;
        $vehicle->description = $req->description;
        $vehicle->price = $req->price;
        $vehicle->is_active = $req->active;
        $vehicle->brand_id = $brand;
        $vehicle->category_id = $category;
        $vehicle->location_id = $location;

        // Handle the file upload
        if ($req->hasFile('attachment')) {
            $file = $req->file('attachment');
            $filename = \Illuminate\Support\Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            // Create a thumbnail version of the image
            $img = Image::make(public_path('uploads/' . $filename));
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path('uploads/thumbnail/' . $filename));

            $vehicle->attachment = $filename;
        }

        try {
            $vehicle->save();
            // Return a success response
            return response()->json(['success' => 'Data is successfully added']);
        } catch (Exception $e) {
            // Log the exception message
            Log::error($e->getMessage());
            // Return an error response
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
