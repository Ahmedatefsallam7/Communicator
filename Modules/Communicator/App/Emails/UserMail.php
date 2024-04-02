<?php

namespace Modules\Communicator\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Communicator\App\Traits\GeneralTrait;

class UserMail extends Mailable implements ShouldQueue {
    use Queueable, SerializesModels, GeneralTrait;

    public $message;

    public function __construct( $message ) {
        $this->message = $message;
    }

    public function build() {
        $template = $this->message->template;
        $data = [
            'user' => $this->message->user->name,
            'subject' => json_decode( $template->subject, true )[ 'ar' ],
            'bodyText' => json_decode( $template->body_text, true )[ 'ar' ],
            'path' => $template->path,
            'var_name' => json_decode( $template->variables, true )[ 'ar' ][ 0 ],
            'var_subject' => json_decode( $template->variables, true )[ 'ar' ][ 1 ],
            'var_body' => json_decode( $template->variables, true )[ 'ar' ][ 2 ],
            'var_url' => json_decode( $template->variables, true )[ 'url' ],
            'app' => $this->message->app,
            'msg_data' => json_decode( $this->message->message_data, true )[ 'ar' ],
        ];

        $file_path = 'communicator::emails.' . $template->path;

        return $this->markdown( $file_path )
        ->subject( $data[ 'subject' ] )
        ->with( $data );
    }

}
