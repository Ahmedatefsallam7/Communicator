<?php

namespace Modules\Communicator\App\Http\Controllers\Actions\Templates;

use Modules\Communicator\App\Models\Template;

class SearchTemplateQueryAction
{
    function execute($request)
    {
        $templates = Template::query();

        return $templates;
    }
}
