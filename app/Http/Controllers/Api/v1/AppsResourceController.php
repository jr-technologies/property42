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
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\LandUnitsRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\PropertyPurposeRepoProvider;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\AssignedFeaturesJsonDocumentsGenerator;

class AppsResourceController extends ApiController
{
    use AssignedFeaturesJsonDocumentsGenerator;

    public $purposes  = "";
    public $statuses  = "";
    public $societies = "";
    public $propertyTypes = "";
    public $propertySubTypes = "";
    public $landUnits   = "";
    public $agencyStaff = "";
    public $response = null;
    public $userAgency ="";
    public $properties ="";

    public function __construct(ApiResponse $response)
    {
        $this->purposes = (new PropertyPurposeRepoProvider())->repo();
        $this->statuses = (new PropertyStatusesRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->propertyTypes = (new PropertyTypesRepoProvider())->repo();
        $this->propertySubTypes = (new PropertySubTypesRepoProvider())->repo();
        $this->landUnits = (new LandUnitsRepoProvider())->repo();
        $this->userAgency = (new AgenciesRepoProvider())->repo();
        $this->agencyStaff = (new UsersJsonRepoProvider())->repo();
        $this->properties = (new PropertiesRepoProvider())->repo();
        $this->response = $response;
    }
    public function dashboardResources(GetDashboardResourcesRequest $request)
    {
        $purposes  = $this->purposes->all();
        $statuses  = $this->statuses->all();
        $societies = $this->societies->all();
        $propertyTypes = $this->propertyTypes->all();
        $propertySubTypes = $this->propertySubTypes->all();
        $landUnits = $this->landUnits->all();
        $user = $request->getUserJsonModel();
        if($user == null)
            return $this->response->respondAuthenticationFailed();

        $agencyStaff = $this->agencyStaff->getStaffByOwner($user->id);
        $agencyStaff = ((sizeof($agencyStaff) == 0)?[$user]:$agencyStaff);
        $propertiesCounts  = $this->properties->countProperties($user->id);
        //dd($landUnits);
        return $this->response->respond([
            'data'=>[
                'resources'=>[
                    'purposes'=>$purposes,
                    'propertyStatuses'=>$statuses,
                    'propertyTypes'=>$propertyTypes,
                    'societies'=>$societies,
                    'propertySubTypes'=>$propertySubTypes,
                    'landUnits'=>$landUnits,
                    'agencyStaff'=>$agencyStaff,
                    'propertiesCounts'=>$propertiesCounts
                ],
                'authUser' => $user
            ],
            'access_token' => session('authUser')->access_token
        ]);
    }
}