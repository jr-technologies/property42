<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\PropertySubType\GetSubTypesByTypeRequest;
use App\Http\Requests\Requests\PropertySubType\AddPropertySubTypeRequest;
use App\Http\Requests\Requests\PropertySubType\DeletePropertySubTypeRequest;
use App\Http\Requests\Requests\PropertySubType\GetAllPropertySubTypesRequest;
use App\Http\Requests\Requests\PropertySubType\UpdatePropertySubTypeRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\PropertySubTypeRepository;

class PropertySubTypeController extends ApiController
{
    private $propertySubTypes = null;
    public $response = null;

    public function __construct
    (
        PropertySubTypeRepository $propertySubTypeRepository,
        ApiResponse $response
    )
    {
        $this->propertySubTypes  = $propertySubTypeRepository;
        $this->response = $response;
    }
    public function store(AddPropertySubTypeRequest $request)
    {
        $subType = $request->getPropertySubTypeModel();
        $subTypeId = $this->propertySubTypes->store($subType);
        $subType->id = $subTypeId;
        return $this->response->respond(['data'=>[
            'propertySubType' => $subType
        ]]);
    }

    public function update(UpdatePropertySubTypeRequest $request)
    {
        $subType = $request->getPropertySubTypeModel();
        $this->propertySubTypes->update($subType);
        return $this->response->respond(['data'=>[
        'propertySubType'=>$subType
        ]]);
    }
    public function all(GetAllPropertySubTypesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertySubType'=>$this->propertySubTypes->all()
        ]]);
    }
    public function delete(DeletePropertySubTypeRequest $request)
    {
        return $this->response->respond(['propertySubType'=>[
            'propertySubType'=>$this->propertySubTypes->delete($request->getPropertySubTypeModel())
        ]]);
    }

    public function getByType(GetSubTypesByTypeRequest $request)
    {
        return $this->response->respond([
            'data'=>['propertySubType'=>$this->propertySubTypes->getByType($request->get('typeId'))
        ]]);

    }
}