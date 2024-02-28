<?php

namespace Modules\Communicator\App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Modules\Communicator\App\Http\Controllers\Actions\Templates\SearchTemplateQueryAction;

class TemplateController extends Controller
{
    function __construct(private SearchTemplateQueryAction $searchTemplateQueryAction)
    {
        $this->searchTemplateQueryAction = $searchTemplateQueryAction;
    }

    public function index(Request $request)
    {
        // Search
        $templates = $this->searchTemplateQueryAction->execute($request)->with('creator');

        // Response
        $data = DataTables::of($templates)->with('creator')
            ->addColumn('created_at', function ($template) {
                return $template->created_at->format('M j, Y | h:i A');
            })
            ->make(true)->original;

        return $this->successResponse(null, $data);
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
