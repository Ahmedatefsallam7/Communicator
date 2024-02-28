<?php

namespace Modules\Communicator\App\Http\Controllers\Actions\Messages;

use Modules\Communicator\App\Models\Message;

class SearchMessageQueryAction
{
    function execute($request)
    {
        $messages = Message::query();

        return $messages;
    }
}
