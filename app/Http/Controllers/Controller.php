<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $per_page = 10;

    public function __construct()
    {
        $get_per_page = getSetting('per_page');
        $this->per_page = $get_per_page ? $get_per_page : $this->per_page;
    }
}
