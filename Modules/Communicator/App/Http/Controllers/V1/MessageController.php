<?php

namespace Modules\Communicator\App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Modules\Communicator\App\Http\Requests\StoreMessageRequest;
use Modules\Communicator\App\Http\Controllers\Actions\Messages\StoreMessageAction;
use Modules\Communicator\App\Http\Controllers\Actions\Messages\SearchMessageQueryAction;

class MessageController extends Controller
{
    function __construct(
        private SearchMessageQueryAction $searchMessageQueryAction,
        private StoreMessageAction $storeMessageAction,
    ) {
        $this->searchMessageQueryAction = $searchMessageQueryAction;
        $this->storeMessageAction = $storeMessageAction;
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

        // return
        return $this->successResponse(null, $data);
    }

    public function store(StoreMessageRequest $request)
    {
        // Data Setup
        $data = $this->unsetNullValues($request->all());

        // Store
        $message = $this->storeMessageAction->execute($data);

        if ($message) {
            // success Response
            return $this->successResponse(__('main.record_has_been_created_successfully'), $message);
        }
        // error Response
        return $this->errorResponse(__('Something went wrong'));
    }


    public function show($id)
    {
    }


    public function update()
    {
    }


    public function destroy($id)
    {
    }
}
