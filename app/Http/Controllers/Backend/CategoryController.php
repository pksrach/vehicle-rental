<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $req)
    {
        if ($req->ajax()) {
            $dataTableList = Category::orderBy('id', 'desc')->get();
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

        return view('backend.category.index');
    }

    public function create(Request $req): \Illuminate\Http\JsonResponse
    {
        $req->validate([
            'name' => 'required'
        ]);

        $category = new Category();
        $category->name = $req->name;
        $category->description = $req->description;

        if ($req->hasFile('attachment')) {
            $category->attachment = $req->attachment->getClientOriginalName();
            $req->attachment->move(public_path('uploads/thumbnail'), $req->attachment->getClientOriginalName());
        }

        try {
            $category->save();
            return response()->json(['success' => 'Data is successfully added']);
        } catch (\Exception $e) {
            // Return the error message as JSON
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }
}
