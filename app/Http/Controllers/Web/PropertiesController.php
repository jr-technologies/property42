<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Property\GetPropertyRequest;
use App\Http\Requests\Requests\Property\UpdatePropertyRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use App\Transformers\Response\PropertyTransformer;

class PropertiesController extends Controller
{
    use PropertyFilesReleaser;
    public $PropertyTransformer = null;
    public $properties = "";

    public function __construct(WebResponse $webResponse, PropertyTransformer $propertyTransformer)
    {
        $this->response = $webResponse;
        $this->PropertyTransformer = $propertyTransformer;
        $this->properties = (new PropertiesJsonRepoProvider())->repo();
    }

    public function update(UpdatePropertyRequest $request)
    {
        return $this->response
            ->setView('userRegistered')
            ->respond($this->PropertyTransformer->transform($request->all()));
    }

    public function search()
    {
        return $this->response->setView('frontend.property_listing')->respond(['data' => [
            'properties' => $this->releaseAllPropertiesFiles($this->properties->all())
        ]]);
    }

    public function index()
    {
        return $this->response->setView('frontend.index')->respond(['data' => [

        ]]);
    }
    public function getById(GetPropertyRequest $request)
    {
        return $this->response->setView('frontend.property_detail')->respond(['data'=>[
            'property'=>$this->releaseAllPropertiesFiles([$this->properties->getById($request->get('propertyId'))])[0]
        ]]);

    }
}
