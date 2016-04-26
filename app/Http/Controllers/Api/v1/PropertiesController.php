<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Events\Events\Property\PropertyCreated;
use App\Http\Requests\Requests\Property\AddPropertyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\PropertiesRepository;
use App\Repositories\Repositories\Sql\PropertyDocumentsRepository;
use App\Repositories\Repositories\Sql\PropertyFeatureValuesRepository;
use Illuminate\Support\Facades\Event;

class PropertiesController extends ApiController

{
    private $properties = null;
    private $propertyFeatureValues = null;
    public $response = null;
    private $propertyDocuments = null;
    public function __construct(PropertiesRepository $properties,ApiResponse $response)
    {
        $this->properties = $properties;
        $this->response = $response;
        $this->propertyFeatureValues = new PropertyFeatureValuesRepository();
        $this->propertyDocuments = new PropertyDocumentsRepository();
    }

    public function store(AddPropertyRequest $request)
    {
        $property = $request->getPropertyModel();
        $propertyId = $this->properties->store($property);
        $this->propertyFeatureValues->storeMultiple($request->getFeaturesValues($propertyId));
        $this->propertyDocuments->storeMultiple($request->getPropertyDocuments($propertyId));

        $property->id = $propertyId;
        Event::fire(new PropertyCreated($property));
        return $this->response->respond(['data' => [
            'property' => $request->getPropertyModel(),
            'features' => $request->getFeaturesValues($propertyId),
        ]]);
    }
}