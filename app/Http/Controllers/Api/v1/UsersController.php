<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Repositories\Sql\UsersRepository;
use App\DB\Providers\SQL\SQLFactoryProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\User\AddUserRequest;
use App\Http\Requests\Requests\User\DeleteUserRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Transformers\Response\UserTransformer;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        UsersRepoInterface $usersRepository, AgenciesRepoInterface $agenciesRepository
    )
    {
        $this->response = $apiResponse;
        $this->userTransformer = $userTransformer;
        $this->users = $usersRepository;
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
