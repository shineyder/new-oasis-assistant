<?php

namespace App\Http\Controllers;

use App\Mail\OasisAssistantMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail($mailTo, $subject, $data = "", $targetFile = "")
    {
        $details = [
            'subject' => $subject,
            'data' => $data,
            'targetFile' => $targetFile
        ];

        Mail::to($mailTo)->send(new OasisAssistantMail($details));
    }
}
