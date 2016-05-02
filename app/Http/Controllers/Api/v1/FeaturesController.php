<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Feature\GetPropertySubTypeAssignedFeatures;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;

class FeaturesController extends ApiController
{
    private $features = null;
    public $response = null;
    public function __construct
    (
        FeaturesRepoProvider $FeatureSection,
        ApiResponse $response
    )
    {
        $this->features  = $FeatureSection->repo();
        $this->response = $response;
    }

    public function allAssigned(GetPropertySubTypeAssignedFeatures $request)
    {
        return $this->response->respond(['data'=>[
            'features'=>$this->features->allAssigned()
        ]]);
    }

}