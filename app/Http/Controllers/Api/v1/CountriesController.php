<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Country\AddCountryRequest;
use App\Http\Requests\Requests\Country\DeleteCountryRequest;
use App\Http\Requests\Requests\Country\GetAllCountriesRequest;
use App\Http\Requests\Requests\Country\UpdateCountryRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Repositories\Sql\CountriesRepository;
use App\Transformers\Response\CountryTransformer;

class CountriesController extends ApiController
{
    private $country = null;
    private $userTransformer = null;
    public $response = null;
    public function __construct
    (
        ApiResponse $response,CountryTransformer $countryTransformer,
        CountriesRepository $countriesRepository
    )
    {
        $this->country =  $countriesRepository;
        $this->userTransformer = $countryTransformer;
        $this->response = $response;
    }
    public function store(AddCountryRequest $request)
    {

        return $this->response->respond(['data' => [
            'country' => $this->country->store($request->getCountryModel())
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
