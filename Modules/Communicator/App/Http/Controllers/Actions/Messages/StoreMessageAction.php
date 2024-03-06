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
    function execute($data)
    {
        return DB::transaction(function () use ($data) {
            $message = Message::create($data);
            $message->update([
                'app' => Str::slug(trim($data['app'])),
                "status" => 'sent'
            ]);

            switch ($message->template->type) {
                case 'email':
                    $this->sendEmail($message, $message->user, $message->template->name);
                    break;
                case 'sms':
                    $this->sendSMS("8X EGYPT", '+2' . $message->user->phone, json_decode($message->message_data)->en);
                    break;
                default:
                    $this->errorResponse('Template View Not Found');
            }
            return new MessageResource($message);
        });
    }
}