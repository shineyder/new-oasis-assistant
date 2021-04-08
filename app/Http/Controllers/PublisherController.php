<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User as Publisher;
use DataTables;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function index()
    {
        return view('publish-master');
    }

    public function data(Request $request)
    {
        $request->ajax();
        $data = Publisher::select('id', 'name', 'email', 'group', 'access');

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('defGroup', function ($data) {
                    $btn = "<button
                                type='button'
                                class='edit btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#setGroupModal'
                                onClick='passId($data->id)'>
                                    Definir
                            </button>";
                    return $btn;
                })
                ->addColumn('defAccess', function ($data) {
                    $btn = "<button
                                type='button'
                                class='edit btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#setAccessModal'
                                onClick='passId($data->id)'>
                                    Definir
                            </button>";
                    return $btn;
                })
                ->rawColumns(['defGroup', 'defAccess'])
                ->make(true);
    }

    public function updateGroup(Request $request)
    {
        $publisher = Publisher::find($request->groupId);
        $publisher->group = $request->group;
        $publisher->save();

        $log = new Event();
        $log->user_id = Auth::user()->id;
        $log->event_type = "attPublisher";
        $log->data1 = "UserIdUpdated";
        $log->desc1 = $request->groupId;
        $log->data2 = "updateGroup";
        $log->desc2 = $request->group;
        $log->save();

        return back()->with('message_success', 'Grupo atualizado com sucesso');
    }

    public function updateAccess(Request $request)
    {
        $publisher = Publisher::find($request->accessId);
        $publisher->access = $request->access;
        $publisher->save();

        $log = new Event();
        $log->user_id = Auth::user()->id;
        $log->event_type = "attPublisher";
        $log->data1 = "UserIdUpdated";
        $log->desc1 = $request->accessId;
        $log->data2 = "updateAccess";
        $log->desc2 = $request->access;
        $log->save();

        return back()->with('message_success', 'Nível de acesso atualizado com sucesso');
    }
}
