<?php

namespace Modules\Communicator\App\Http\Controllers\Actions\Messages;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Modules\Communicator\App\Models\Message;
use Modules\Communicator\App\Traits\GeneralTrait;
use Modules\Communicator\App\resources\MessageResource;

class StoreMessageAction
{
    use GeneralTrait;
    public function execute($data)
    {
        return DB::transaction(function () use ($data) {
            // Create a new message
            $message = Message::create($data);

            // Update the message with app slug and status
            $message->update([
                'app' => Str::slug(trim($data['app'])),
                'status' => 'sent'
            ]);

            // Determine the template type and take appropriate action
            $templateType = $message->template->type;
            switch ($templateType) {
                case 'email':
                    // Send email
                    $this->sendEmail($message, $message->user, $message->template->name);
                    break;
                case 'sms':
                    // Send SMS
                    $this->sendSMS("8X EGYPT", '+2' . $message->user->phone, json_decode($message->message_data)->en);
                    break;
                default:
                    // Handle error for unknown template type
                    $this->errorResponse('Template View Not Found');
            }

            // Return the message resource
            return new MessageResource($message);
        });
    }


}
