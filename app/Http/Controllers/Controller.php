<?php

namespace App\Http\Controllers;

use Modules\Communicator\App\Traits\GeneralTrait;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use GeneralTrait, AuthorizesRequests, ValidatesRequests;
}
