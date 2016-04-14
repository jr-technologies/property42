<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Auth\AuthenticationRequest;
use App\Http\Requests\Requests\Auth\LoginRequest;
use App\Http\Requests\Requests\Auth\RegistrationRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Libs\Auth\Api as Authenticator;
use App\Models\Sql\User;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Repositories\Repositories\Sql\AgenciesRepository;
use App\Repositories\Repositories\Sql\UsersRepository;
use App\Transformers\Response\UserTransformer;

class AuthController extends ApiController
{
    private $auth = null;
    private $users = null;
    private $agencies = null;
    private $userTransformer;
    public $response;
    public function __construct
    (
        ApiResponse $response, Authenticator $authenticator,
        UsersRepository $usersRepository, AgenciesRepository $agenciesRepository,
        UserTransformer $userTransformer
    )
    {
        $this->auth = $authenticator;
        $this->users = $usersRepository;
        $this->agencies = $agenciesRepository;
        $this->response = $response;
        $this->userTransformer = $userTransformer;
    }
    public function login(LoginRequest $request)
    {
        if(!$this->auth->attempt($request->getCredentials()))
            return $this->response->respondInvalidCredentials();

        $authenticatedUser = $this->auth->login($this->users->findByEmail($request->get('email')));

        return $this->response->respond(['data'=>[
            'authUser' => $authenticatedUser
        ]]);
    }

    public function register(RegistrationRequest $request)
    {
        $userId = $this->users->store($request->getUserModel());
        if($request->userIsAgent())
        {
            $agency = $request->getAgencyModel();
            $agency->userId = $userId;
            $agencyId = $this->agencies->storeAgency($agency);
            $this->agencies->addCities($agencyId, $request->getAgencyCities());
        }
        return $this->response->respond(['data'=>[
            'user'=>$this->users->getById($userId)
        ]]);
    }
}
