<?php

namespace Modules\Communicator\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $message;
    public $subject;
    public $bodyText;

    public function __construct($message, $subject, $bodyText)
    {
        $this->message = $message;
        $this->subject = $subject;
        $this->bodyText = $bodyText;
    }

    public function build()
    {
        return $this->markdown('communicator::emails.user_mail')
            ->subject($this->subject)
            ->with([
                'message' => $this->message,
                'bodyText' => $this->bodyText
            ]);
    }
}
