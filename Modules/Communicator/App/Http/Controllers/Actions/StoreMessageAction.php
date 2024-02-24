<?php

namespace Modules\Communicator\App\Http\Controllers\Actions;

use Illuminate\Support\Str;
use Modules\Communicator\App\Models\Message;
use Modules\Communicator\App\Models\Template;
use Modules\Communicator\App\resources\MessageResource;

class StoreMessageAction
{
    function execute($data)
    {


        // check if slug not in request add it's value from name
        $data['app'] = Str::slug(trim($data['app']));

        // store order
        $message = Message::create($data);


        // response
        return new MessageResource($message);
    }
}
