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

class PropertiesController extends ApiController

{
    private $properties = null;
    public $response = null;

    public function __construct(PropertiesRepository $properties,ApiResponse $response)
    {
        $this->properties = $properties;
        $this->response = $response;
    }

    public function store(AddPropertyRequest $request)
    {
        dd($this->properties->store($request->getPropertyModel()));
    }
}