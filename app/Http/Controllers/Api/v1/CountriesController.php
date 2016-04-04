<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Country\AddCountryRequest;
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
        CountriesRepository $countriesRepository )
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
}
