<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OasisAssistantMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewName = strtolower(str_replace(' ', '-', $this->details['subject']));
        $details = $this->details;

        if ($details['targetFile'] == "") :
            return $this->subject($this->details['subject'])
            ->markdown('emails.' . $viewName, compact('details'));
        else :
            return $this->subject($this->details['subject'])
                    ->markdown('emails.' . $viewName, compact('details'))
                    ->attach(storage_path('app\public\files') . "\\" . $details['targetFile']);
        endif;
    }
}
