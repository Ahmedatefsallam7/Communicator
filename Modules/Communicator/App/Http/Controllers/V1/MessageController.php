<?php

namespace Modules\Communicator\App\Http\Controllers\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Modules\Communicator\App\Models\Message;
use Modules\Communicator\App\Emails\UserMail;
use Modules\Communicator\App\resources\MessageResource;
use Modules\Communicator\App\Http\Requests\StoreMessageRequest;
use Modules\Communicator\App\Http\Requests\UpdateMessageRequest;
use Modules\Communicator\App\Http\Controllers\Actions\StoreMessageAction;
use Modules\Communicator\App\Http\Controllers\Actions\UpdateMessageAction;

class MessageController extends Controller
{
    function __construct(
        private StoreMessageAction $storeMessageAction,
        private UpdateMessageAction $updateMessageAction,
    ) {
        $this->updateMessageAction = $updateMessageAction;
    }

    public function index()
    {
        // all messages
        $messages = MessageResource::collection(Message::latest()->get());
        if ($messages->count()) {
            // Response
            return $this->successResponse(__('main.records_has_been_retrieved_successfully'), $messages);
        }
        return $this->notFoundResponse();
    }

    public function store(StoreMessageRequest $request)
    {

        // Data Setup
        $data = $this->unsetNullValues($request->all());

        // Store
        $message = $this->storeMessageAction->execute($data);

        // Response
        return $this->successResponse(__('main.record_has_been_created_successfully'), $message);
    }


    public function show($id)
    {
    }


    public function update(UpdateMessageRequest $request, $id)
    {
        // Data Setup
        $data = $this->unsetNullValues($request->all());

        // Update
        $message = $this->updateMessageAction->execute($data);

        // Response
        return $this->successResponse(__('main.record_has_been_updated_successfully'),  $message);
    }


    public function destroy($id)
    {
    }
}
