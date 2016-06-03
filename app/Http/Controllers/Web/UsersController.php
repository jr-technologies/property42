<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\User\AddUserRequest;
use App\Http\Requests\Requests\User\DeleteUserRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Transformers\Response\UserTransformer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UsersController extends Controller
{
    public $userTransformer = null;
    public function __construct(WebResponse $webResponse, UserTransformer $userTransformer)
    {
        $this->response = $webResponse;
        $this->userTransformer = $userTransformer;
    }

    public function store(AddUserRequest $request){
        return $this->response
            ->setView('userRegistered')
            ->respond($this->userTransformer->transform($request->all()));
    }


}
