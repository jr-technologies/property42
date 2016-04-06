<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\City\AddCityRequest;
use App\Http\Requests\Requests\City\DeleteCityRequest;
use App\Http\Requests\Requests\City\GetAllCitiesRequest;
use App\Http\Requests\Requests\City\UpdateCityRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\CitiesRepository;
use App\Transformers\Response\CityTransformer;

class CitiesController extends ApiController
{
    private $cities = null;
    public $response = null;
    public function __construct
    (
        ApiResponse $response,CityTransformer $countryTransformer,
        CitiesRepository $citiesRepository
    )
    {
        $this->cities =  $citiesRepository;
        $this->response = $response;
    }
    public function store(AddCityRequest $request)
    {
        return $this->response->respond(['data' => [
            'country' => $this->cities->store($request->getCityModel())
        ]]);
    }
    public function update(UpdateCityRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->cities->update($request->getCityModel())
        ]]);
    }
    public function delete(DeleteCityRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->cities->delete($request->getCityModel())
        ]]);
    }
    public function all(GetAllCitiesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->cities->all()
        ]]);
    }
    public function getByCountry(GetByCountryRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->cities->all()
        ]]);
    }
    public function GetBySociety(GetBySocietyRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->cities->all()
        ]]);
    }
}
