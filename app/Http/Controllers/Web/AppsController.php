<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Apps\GetDashboardAppRequest;
use App\Http\Responses\Responses\WebResponse;


class AppsController extends Controller
{
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
    }

    public function dashboard(GetDashboardAppRequest $dashboardRequest)
    {
        $version = $dashboardRequest->version();
        return $this->response->app('dashboard', $version);
    }


}
