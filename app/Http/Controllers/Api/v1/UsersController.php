<?php

namespace App\Http\Controllers\Api\V1;

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
    private $agencyRepo;
    public $response;
    public function __construct
    (
        ApiResponse $apiResponse, UserTransformer $userTransformer,
        UsersRepoProvider $usersRepository, AgenciesRepoInterface $agenciesRepository
    )
    {
        $this->response = $apiResponse;
        $this->userTransformer = $userTransformer;
        $this->users = $usersRepository->repo();
        $this->agencyRepo = $agenciesRepository;
    }

    public function index()
    {
        $users = $this->users->all();
        return $this->response->respond(['data'=>[
            'total' => $users->count(),
            'users'=>$users->all()
        ]]);
    }

    public function store(AddUserRequest $request)
    {

    }

    private function storeAgency(array $agencyInfo, $userId)
    {

    }
}
