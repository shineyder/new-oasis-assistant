<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PublisherDataTable;
use App\Models\User;
use DataTables;

class PublisherController extends Controller
{
    public function index()
    {
        return view('publish-master');
    }

    public function data(Request $request)
    {
        $request->ajax();
        $data = User::select('*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('defGroup', function () {
                    $btn = '<button type="button" class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#setGroupModal">Definir</button>';
                    return $btn;
                })
                ->addColumn('defAccess', function () {
                    $btn = '<button type="button" class="edit btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#setAccessModal">Definir</button>';
                    return $btn;
                })
                ->rawColumns(['defGroup', 'defAccess'])
                ->make(true);
    }
}
