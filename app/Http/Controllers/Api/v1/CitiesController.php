<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\City\AddCityRequest;
use App\Http\Responses\Responses\ApiResponse;
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
    public function update(UpdateCountryRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->country->update($request->getCountryModel())
        ]]);
    }
    public function delete(DeleteCountryRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->country->delete($request->getCountryModel())
        ]]);
    }
    public function all(GetAllCountriesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->country->all()
        ]]);
    }
}
