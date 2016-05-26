<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\AppsResources\GetDashboardResourcesRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\LandUnitsRepoProvider;
use App\Repositories\Providers\Providers\PropertyPurposeRepoProvider;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;

class AppsResourceController extends ApiController
{
    public $purposes  = "";
    public $statuses  = "";
    public $societies = "";
    public $propertyTypes = "";
    public $propertySubTypes = "";
    public $landUnits   = "";
    public $agencyStaff = "";

    public function __construct()
    {
        $this->purposes = (new PropertyPurposeRepoProvider())->repo();
        $this->statuses = (new PropertyStatusesRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->propertyTypes = (new PropertyTypesRepoProvider())->repo();
        $this->propertySubTypes = (new PropertySubTypesRepoProvider())->repo();
        $this->landUnits = (new LandUnitsRepoProvider())->repo();
    }
    public function dashboardResources(GetDashboardResourcesRequest $request)
    {
        $purposes = $this->purposes->all();
        $statuses = $this->statuses->all();
        $societies = $this->societies->all();
        $propertyTypes = $this->propertyTypes->all();
        $propertySubTypes = $this->propertySubTypes->all();
        $landUnits = $this->landUnits->all();
        $user = $request->getUserModel();
        dd($user);
    }
}