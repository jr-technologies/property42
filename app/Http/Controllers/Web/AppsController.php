<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Apps\GetAddPropertyWithAuthAppRequest;
use App\Http\Requests\Requests\Apps\GetDashboardAppRequest;
use App\Http\Responses\Responses\WebResponse;


class AppsController extends Controller
{
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
    }

    public function dashboard(GetDashboardAppRequest $appRequest)
    {
        $version = $appRequest->version();
        return $this->response->app('dashboard', $version);
    }
    public function addPropertyWithAuth(GetAddPropertyWithAuthAppRequest $appRequest)
    {
        if(!$appRequest->isNotAuthentic()){
            die(header('Location: '.url('/').'/dashboard#/home/properties/add'));
        }

        \Illuminate\Support\Facades\Blade::setEscapedContentTags('[[', ']]');
        \Illuminate\Support\Facades\Blade::setContentTags('[[[', ']]]');

        $version = $appRequest->version();
        $purposes  = $this->purposes->all();
        $societies = $this->societies->all();
        $propertyTypes = $this->propertyTypes->all();
        $propertySubTypes = $this->propertySubTypes->all();
        $landUnits = $this->landUnits->all();
        $subTypeAssignedFeaturesJson = $this->assignedFeaturesJson->all();
        $userRoles = (new RolesRepoProvider())->repo()->all();
        return $this->response->app('AddPropertyWithAuth', $version, ['data' => [
            'resources'=>[
                'purposes'=>$purposes,
                'propertyTypes'=>$propertyTypes,
                'societies'=>$societies,
                'propertySubTypes'=>$propertySubTypes,
                'landUnits'=>$landUnits,
                'subTypeAssignedFeatures'=>$subTypeAssignedFeaturesJson,
                'userRoles' => $userRoles
            ]
        ]]);
    }
}
