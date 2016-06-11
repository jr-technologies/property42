<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\User\GetUserRequest;
use App\Http\Requests\Requests\User\UpdateUserRequest;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Repositories\Repositories\Sql\UsersRepository;
use App\Http\Requests\Requests\User\AddUserRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;
use App\Transformers\Response\UserTransformer;

class UsersController extends ApiController
{
    private $userTransformer;
    /**
     * @var UsersRepository::class
     */
    private $users;
    private $usersJsonRepo;
    private $agencyRepo;
    public $response;
    public function __construct
    (
        ApiResponse $apiResponse, UserTransformer $userTransformer,
        UsersRepoProvider $usersRepository, AgenciesRepoInterface $agenciesRepository,
        UsersJsonRepoProvider $usersJsonRepoProvider
    )
    {
        $this->response = $apiResponse;
        $this->userTransformer = $userTransformer;
        $this->users = $usersRepository->repo();
        $this->agencyRepo = $agenciesRepository;
        $this->usersJsonRepo = $usersJsonRepoProvider->repo();
    }

    /**
     * @return \App\Http\Responses\Responses\json
     */
    public function index()
    {
        $users = $this->users->all();
        return $this->response->respond(['data'=>[
            'total' => $users->count(),
            'users'=>$users->all()
        ]]);
    }

    public function find(GetUserRequest $request)
    {
        return $this->response->respond(['data'=>[
            'user' => $this->usersJsonRepo->find($request->get('userId'))
        ]]);
    }

    public function store(AddUserRequest $request)
    {

    }

    /**
     * @param UpdateUserRequest $request
     * @return \App\Http\Responses\Responses\json
     */
    public function updateUser(UpdateUserRequest $request)
    {
        $user = $request->getUserModel();
        $this->users->update($user);
        return $this->response->respond(['data'=>[
                'user'=>$user
            ]]);
    }
    private function storeAgency(array $agencyInfo, $userId)
    {

    }
}
