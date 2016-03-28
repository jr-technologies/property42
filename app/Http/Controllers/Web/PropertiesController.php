<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Property\UpdatePropertyRequest;
use App\Http\Requests\Requests\User\AddUserRequest;
use App\Http\Requests\Requests\User\DeleteUserRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Transformers\Response\PropertyTransformer;
use App\Transformers\Response\UserTransformer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PropertiesController extends Controller
{
    public $PropertyTransformer = null;
    public function __construct(WebResponse $webResponse, PropertyTransformer $propertyTransformer)
    {
        $this->response = $webResponse;
        $this->PropertyTransformer = $propertyTransformer;
    }

    public function update(UpdatePropertyRequest $request){
        //dd($this->PropertyTransformer->transform($request->all()));
        return $this->response
            ->setView('userRegistered')
            ->respond($this->PropertyTransformer->transform($request->all()));
    }


}
