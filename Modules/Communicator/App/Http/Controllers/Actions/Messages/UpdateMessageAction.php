<?php

namespace Modules\Communicator\App\Http\Controllers\Actions\Messages;

use Modules\Communicator\App\Models\Message;
use Modules\Communicator\App\resources\MessageResource;

class UpdateMessageAction
{
    public function execute($data)
    {
        // Get Record
        $message = Message::find($data['id']);

        // Update
        $message->update($data);

        // Return Resource
        return new MessageResource($message);
    }
}
