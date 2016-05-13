<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\FeatureSection\AddFeatureSectionRequest;
use App\Http\Requests\Requests\FeatureSection\DeleteFeatureSectionRequest;
use App\Http\Requests\Requests\FeatureSection\GetAllFeatureSectionRequest;
use App\Http\Requests\Requests\FeatureSection\UpdateFeatureSectionRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\FeatureSectionsRepoProvider;
use App\Repositories\Repositories\Sql\FeatureSectionRepository;

class FeatureSectionsController extends ApiController
{
    private $FeatureSection = null;
    public $response = null;
    public function __construct
    (
        FeatureSectionsRepoProvider $FeatureSection,
        ApiResponse $response
    )
    {
        $this->FeatureSection  = $FeatureSection->repo();
        $this->response = $response;
    }
    public function store(AddFeatureSectionRequest $request)
    {
        $FeatureSection =$request->getFeatureSectionModel();
        $FeatureSection->id = $this->FeatureSection->store($FeatureSection);
        return $this->response->respond(['data' => [
            'featureSection' => $FeatureSection
        ]]);
    }
    public function all(GetAllFeatureSectionRequest $request)
    {
        return $this->response->respond(['data'=>[
            'featureSection'=>$this->FeatureSection->all()
        ]]);
    }
    public function delete(DeleteFeatureSectionRequest $request)
    {
        return $this->response->respond(['data'=>[
            'featureSection'=>$this->FeatureSection->delete($request->getFeatureSectionModel())
        ]]);
    }
    public function update(UpdateFeatureSectionRequest $request)
    {
        $FeatureSection =$request->getFeatureSectionModel();
        $this->FeatureSection->update($FeatureSection);
        return $this->response->respond(['data' => [
            'featureSection' => $FeatureSection
        ]]);
    }
    public function getPropertyFeatures(GetPropertyFeatures $request)
    {
        return $this->response->respond([
            'data'=>[
                'featureSection'=>$this->FeatureSection
            ]
        ]);
    }


}