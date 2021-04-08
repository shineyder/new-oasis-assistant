<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ReportController extends Controller
{
    public function index()
    {
        return view('report');
    }

    public function data(Request $request)
    {
        if (Auth::user()->access < 8) :
            return back()->with('message_danger', 'Acesso negado!');
        endif;

        $request->ajax();
        $data = Event::join('users', 'events.user_id', '=', 'users.id')
            ->join('territories', 'events.territory_id', '=', 'territories.id')
            ->select(
                'users.id',
                'users.name',
                'territories.map',
                'territories.block',
                'events.desc2',
                'events.desc3',
                'events.desc4',
            )
            ->where('user_id', Auth::user()->id);

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('defStatus', function ($data) {
                    $btn = "<button
                                type='button'
                                class='edit btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#updateReportModal'
                                onClick='passIdUpload($data->id)'
                                style='margin-right: 10px;'>
                                    Atualizar
                            </button>";
                    $btn = $btn . "<button
                                type='button'
                                class='edit btn btn-danger btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#deleteReportModal'
                                onClick='passIdDelete($data->id)'>
                                    Deletar
                            </button>";
                    return $btn;
                })
                ->rawColumns(['defStatus'])
                ->make(true);
    }

    public function masterIndex()
    {
        if (Auth::user()->access < 8) :
            return back()->with('message_danger', 'Acesso negado!');
        endif;

        return view('report-master');
    }

    public function masterData(Request $request)
    {
        if (Auth::user()->access < 8) :
            return back()->with('message_danger', 'Acesso negado!');
        endif;

        $request->ajax();
        $data = Event::join('users', 'events.user_id', '=', 'users.id')
            ->join('territories', 'events.territory_id', '=', 'territories.id')
            ->select(
                'users.id',
                'users.name',
                'territories.map',
                'territories.block',
                'events.desc2',
                'events.desc3',
                'events.desc4',
            );

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('defStatus', function ($data) {
                    $btn = "<button
                                type='button'
                                class='edit btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#updateReportModal'
                                onClick='passIdUpload($data->id)'
                                style='margin-right: 10px;'>
                                    Atualizar
                            </button>";
                    $btn = $btn . "<button
                                type='button'
                                class='edit btn btn-danger btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#deleteReportModal'
                                onClick='passIdDelete($data->id)'>
                                    Deletar
                            </button>";
                    return $btn;
                })
                ->rawColumns(['defStatus'])
                ->make(true);
    }

    public function updateStatus(Request $request)
    {
        $contact = Event::find($request->reportUpdateId);
        //$contact->status_now = $request->status;
        $contact->save();

        return back()->with('message_success', 'Relatório atualizado com sucesso');
    }

    public function deleteStatus(Request $request)
    {
        $contact = Event::find($request->reportDeleteId);
        //$contact->status_now = $request->status;
        $contact->save();

        return back()->with('message_success', 'Relatório atualizado com sucesso');
    }
}
