<?php

namespace Modules\Communicator\App\Http\Controllers\Actions\Messages;

use Illuminate\Support\Str;
use App\Traits\GeneralTrait;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Modules\Communicator\App\Models\Message;
use Modules\Communicator\App\resources\MessageResource;

class StoreMessageAction
{
    use GeneralTrait;
    function execute($data)
    {
        $data['app'] = Str::slug(trim($data['app']));

        try {
            DB::transaction(function () use ($data) {
                $message = Message::create($data);

                switch ($message->template->type) {
                    case 'email':
                        $this->sendEmail($message, $message->user, $message->template->name);
                        break;
                    case 'sms':
                        $this->sendSMS("8X EGYPT", '+2' . $message->user->phone, json_decode($message->message_data)->en);
                        break;
                    default:
                        throw new InvalidArgumentException("Invalid template type");
                }

                return new MessageResource($message);
            });
        } catch (\Throwable $ex) {
            return $this->errorResponse(__($ex->getMessage()), 422);
        }
    }
}