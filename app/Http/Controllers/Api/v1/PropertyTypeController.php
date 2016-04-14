<?php
/**
 * Created by WAQAS.
 * User: JR Tech
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\PropertyPurposes\GetAllPropertyPurposesRequest;
use App\Http\Requests\Requests\PropertyType\AddPropertyTypeRequest;
use App\Http\Requests\Requests\PropertyType\DeletePropertyTypeRequest;
use App\Http\Requests\Requests\PropertyType\UpdatePropertyTypeRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\PropertyTypeRepository;

class PropertyTypeController extends ApiController
{
    private $propertyTypeRepository = null;
    public $response = null;
    public function __construct
    (
        PropertyTypeRepository $propertyTypeRepository,
        ApiResponse $response
    )
    {
        $this->propertyTypeRepository  = $propertyTypeRepository;
        $this->response = $response;
    }
    public function store(AddPropertyTypeRequest $request)
    {
        return $this->response->respond(['data'=>['propertyType'=>
                $this->propertyTypeRepository->store($request->getPropertyTypeModel())]]);
    }
    public function all(GetAllPropertyPurposesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyType'=>$this->propertyTypeRepository->all()
        ]]);
    }
    public function delete(DeletePropertyTypeRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyType'=>$this->propertyTypeRepository->delete($request->getPropertyTypeModel())
        ]]);
    }
    public function update(UpdatePropertyTypeRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyType'=>$this->propertyTypeRepository->update($request->getPropertyTypeModel())
        ]]);
    }
}