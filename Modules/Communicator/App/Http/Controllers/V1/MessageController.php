<?php

namespace Modules\Communicator\App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Modules\Communicator\App\Http\Requests\StoreMessageRequest;
use Modules\Communicator\App\Http\Requests\UpdateMessageRequest;
use Modules\Communicator\App\Http\Controllers\Actions\Messages\StoreMessageAction;
use Modules\Communicator\App\Http\Controllers\Actions\Messages\UpdateMessageAction;
use Modules\Communicator\App\Http\Controllers\Actions\Messages\SearchMessageQueryAction;

class MessageController extends Controller
{
    function __construct(
        private SearchMessageQueryAction $searchMessageQueryAction,
        private StoreMessageAction $storeMessageAction,
        private UpdateMessageAction $updateMessageAction,
    ) {
        $this->searchMessageQueryAction = $searchMessageQueryAction;
        $this->storeMessageAction = $storeMessageAction;
        $this->updateMessageAction = $updateMessageAction;
    }

    public function index(Request $request)
    {
        // Search
        $messages = $this->searchMessageQueryAction->execute($request)->with('creator');

        // Response
        $data = DataTables::of($messages)->with('creator')
            ->addColumn('created_at', function ($message) {
                return $message->created_at->format('M j, Y | h:i A');
            })
            ->make(true)->original;

        return $this->successResponse(null, $data);
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
