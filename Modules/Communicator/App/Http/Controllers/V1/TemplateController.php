<?php

namespace Modules\Communicator\App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Communicator\App\Models\Template;

class TemplateController extends Controller
{

    public function index()
    {
        $templates = Template::get();

        if ($templates->count()) {
            // Response
            return $this->successResponse(__('main.records_has_been_retrieved_successfully'), $templates);
        }
        return $this->notFoundResponse();
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
