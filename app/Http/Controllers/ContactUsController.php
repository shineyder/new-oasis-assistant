<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
