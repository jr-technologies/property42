<?php
/**
 * Created by WAQAS.
 * User: JR Tech
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\Requests\PropertyPurposes\AddPropertyPurposeRequest;
use App\Http\Requests\Requests\PropertyPurposes\DeletePropertyPurposeRequest;
use App\Http\Requests\Requests\PropertyPurposes\GetAllPropertyPurposesRequest;
use App\Http\Requests\Requests\PropertyPurposes\UpdatePropertyPurposeRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\PropertyPurposeRepository;


class PropertyPurposeController extends ApiController
{
    private $propertyPurposeRepository = null;
    public $response = null;
    public function __construct
    (
        PropertyPurposeRepository $propertyPurposeRepository,
        ApiResponse $response
    )
    {
        $this->propertyPurposeRepository  = $propertyPurposeRepository;
        $this->response = $response;
    }
    public function store(AddPropertyPurposeRequest $request)
    {
        return $this->response->respond(['data'=>['PropertyPurpose'=>
                $this->propertyPurposeRepository->store($request->getPropertyPurposeModel())]]);
    }
    public function all(GetAllPropertyPurposesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'PropertyPurpose'=>$this->propertyPurposeRepository->all()
        ]]);
    }
    public function delete(DeletePropertyPurposeRequest $request)
    {
        return $this->response->respond(['data'=>[
            'PropertyPurpose'=>$this->propertyPurposeRepository->delete($request->getPropertyPurposeModel())
        ]]);
    }
    public function update(UpdatePropertyPurposeRequest $request)
    {
        return $this->response->respond(['data'=>[
            'PropertyPurpose'=>$this->propertyPurposeRepository->update($request->getPropertyPurposeModel())
        ]]);
    }
}