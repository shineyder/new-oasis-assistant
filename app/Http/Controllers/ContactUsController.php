<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contact-us');
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'msg' => 'required|min: 20',
            'subject' => 'required'
        ]);

        $image = new ImageUploadController();
        $fileName = $image->imageUpload($request["fileToUploadTalk"]);

        $ticket = date_timestamp_get(date_create()) . $request->id;

        //Envia email com os dados da solicitação para o ADM
        $emailSend = new MailController();
        $emailSend->sendMail("adrianoshineyder@hotmail.com", "Solicitacao", ['msg' => $validated['msg']], $fileName);

        //Envia email para o usuario da solicitação com o Ticket da solicitação
        $emailSend->sendMail(Auth::user()->email, "Fale Conosco", $ticket);

        //Apaga a img
        if ($fileName != '') :
            unlink(storage_path('app\public\files') . "\\" . $fileName);
        endif;

        $talk = new ContactUs();
        $talk->user_id = $request->id;
        $talk->subject = $validated['subject'];
        $talk->message = $validated['msg'];
        $talk->ticket = $ticket;
        $talk->save();

        return back()->with('message_success', 'Sua solicitação foi enviada com sucesso');
    }

    public function masterIndex()
    {
        return view('contact-us-master');
    }

    public function masterData(Request $request)
    {
        $request->ajax();
        $data = ContactUs::join('users', 'contact_us.user_id', '=', 'users.id')
            ->select(
                'contact_us.id',
                'users.name',
                'users.email',
                'contact_us.subject',
                'contact_us.message',
                'contact_us.status_now',
                'contact_us.ticket',
                'contact_us.created_at'
            );

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('defStatus', function ($data) {
                    $btn = "<button
                                type='button'
                                class='edit btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#setStatusModal'
                                onClick='passId($data->id)'>
                                    Definir
                            </button>";
                    return $btn;
                })
                ->editColumn('created_at', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)
                        ->format('H:i d/m/Y');
                    return $formatedDate;
                })
                ->rawColumns(['defStatus'])
                ->make(true);
    }

    public function masterUpdateStatus(Request $request)
    {
        $contact = ContactUs::find($request->statusId);
        $contact->status_now = $request->status;
        $contact->save();

        return back()->with('message_success', 'Status atualizado com sucesso');
    }
}
