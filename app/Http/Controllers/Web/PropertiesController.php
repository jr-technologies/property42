<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Property\GetPropertyRequest;
use App\Http\Requests\Requests\Property\SearchPropertiesRequest;
use App\Http\Requests\Requests\Property\UpdatePropertyRequest;
use App\Http\Requests\Requests\User\GetAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\BlocksRepoProvider;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use App\Transformers\Response\PropertyTransformer;

class PropertiesController extends Controller
{
    use PropertyFilesReleaser;
    public $PropertyTransformer = null;
    public $properties = "";
    public $societies =null;
    public $blocks =null;
    public $propertyTypes = null;
    public $propertySubtypes =null;

    public function __construct(WebResponse $webResponse, PropertyTransformer $propertyTransformer)
    {
        $this->response = $webResponse;
        $this->PropertyTransformer = $propertyTransformer;
        $this->properties = (new PropertiesJsonRepoProvider())->repo();
       $this->societies = (new SocietiesRepoProvider())->repo();
       $this->blocks = (new BlocksRepoProvider())->repo();
       $this->propertyTypes = (new PropertyTypesRepoProvider())->repo();
       $this->propertySubtypes = (new PropertySubTypesRepoProvider())->repo();
    }

    public function update(UpdatePropertyRequest $request)
    {
        return $this->response
            ->setView('userRegistered')
            ->respond($this->PropertyTransformer->transform($request->all()));
    }

    public function search(SearchPropertiesRequest $request)
    {
        return $this->response->setView('frontend.property_listing')->respond(['data' => [
            'properties' => $this->releaseAllPropertiesFiles($this->properties->search($request->getParams()))
        ]]);
    }

    public function index()
    {
        return $this->response->setView('frontend.index')->respond(['data' => [
            'societies'=>$this->societies->all(),
            'propertyTypes'=>$this->propertyTypes->all(),
            'propertySubtypes'=>$this->propertySubtypes->all(),
        ]]);
    }
    public function getById(GetPropertyRequest $request)
    {
        return $this->response->setView('frontend.property_detail')->respond(['data'=>[
            'property'=>$this->releaseAllPropertiesFiles([$this->properties->getById($request->get('propertyId'))])[0]
        ]]);

    }

}
