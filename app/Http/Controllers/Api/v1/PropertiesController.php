<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Property\AddPropertyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\PropertiesRepository;
use App\Repositories\Repositories\Sql\PropertyFeatureValuesRepository;

class PropertiesController extends ApiController

{
    private $properties = null;
    private $propertyFeatureValues = null;
    public $response = null;

    public function __construct(PropertiesRepository $properties,ApiResponse $response)
    {
        $this->properties = $properties;
        $this->response = $response;
        $this->propertyFeatureValues = new PropertyFeatureValuesRepository();
    }

    public function store(AddPropertyRequest $request)
    {
        $propertyId = $this->properties->store($request->getPropertyModel());
        $this->propertyFeatureValues->storeMultiple($request->getFeaturesValues($propertyId));
        return $this->response->respond(['data' => [
            'property' => $request->getPropertyModel(),
            'features' => $request->getFeaturesValues($propertyId),
        ]]);
    }
}