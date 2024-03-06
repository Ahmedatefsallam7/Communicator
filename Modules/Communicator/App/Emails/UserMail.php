<?php

namespace Modules\Communicator\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Communicator\App\Traits\GeneralTrait;

class UserMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, GeneralTrait;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function build()
    {
        $file_path = 'communicator::emails.' . $this->message->template->path;
        $data = [
            "user" => $this->message->user->name,
            "subject" => json_decode($this->message->template->subject, true)['ar'],
            "bodyText" => json_decode($this->message->template->body_text, true)['ar'],
            "path" => $this->message->template->path,
            "var_name" => json_decode($this->message->template->variables, true)['ar'][0],
            "var_subject" => json_decode($this->message->template->variables, true)['ar'][1],
            "var_body" => json_decode($this->message->template->variables, true)['ar'][2],
            "var_url" => json_decode($this->message->template->variables, true)['url'],
            "app" => $this->message->app,
            "msg_data" => json_decode($this->message->message_data, true)['ar'],
        ];

        return $this->markdown($file_path)
            ->subject(json_decode($this->message->template->subject, true)['ar'])
            ->with($data);
    }
}