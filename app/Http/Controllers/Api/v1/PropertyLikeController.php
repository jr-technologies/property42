<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\PropertyLike\AddPropertyLikeRequest;
use App\Http\Requests\Requests\PropertyLike\DeletePropertyLikeRequest;
use App\Http\Requests\Requests\PropertyLike\GetAllPropertyLikeRequest;
use App\Http\Requests\Requests\PropertyLike\UpdatePropertyLikeRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\PropertyLikeRepository;
use App\Transformers\Response\CityTransformer;

class PropertyLikeController extends ApiController
{
    private $PropertyLike = null;
    public $response = null;
    public function __construct
    (
        ApiResponse $response,CityTransformer $countryTransformer,
        PropertyLikeRepository $PropertyLikeRepository
    )
    {
        $this->PropertyLike =  $PropertyLikeRepository;
        $this->response = $response;
    }
    public function store(AddPropertyLikeRequest $request)
    {
        $propertyLike = $request->getPropertyLikeModel();
        $propertyLike->id = $this->PropertyLike->store($propertyLike);
        $this->PropertyLike->getTotalLikes($propertyLike);
        return $this->response->respond(['data' => [
            'propertyLike' => $propertyLike
        ]]);
    }

    public function delete(DeletePropertyLikeRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyLike'=>$this->PropertyLike->delete($request->getPropertyLikeModel())
        ]]);
    }
    public function all(GetAllPropertyLikeRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyLike'=>$this->PropertyLike->all()
        ]]);
    }



}
