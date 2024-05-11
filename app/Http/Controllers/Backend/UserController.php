<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $req)
    {
        if ($req->ajax()) {
            $dataTableList = User::orderBy('id', 'desc')->get();
            return DataTables::of($dataTableList)
                ->addIndexColumn()
                ->addColumn('email', function ($row) {
                    return $row->email ? $row->email : 'N/A';
                })
                ->addColumn('username', function ($row) {
                    return $row->username ? $row->username : 'N/A';
                })
                ->addColumn('user_type', function ($row) {
                    if ($row->user_type == 1) {
                        return 'Customer';
                    } elseif ($row->user_type == 2) {
                        return 'Staff';
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button type="button" data-id="' . $row->id . '" class="resetPassword btn btn-primary btn-sm">Reset Password</button>
                    ';
                })
                ->rawColumns(['action', 'user_type'])
                ->make(true);
        }

        return view('backend.user.index');
    }
}
