<?php

namespace App\Http\Controllers\Api\V1;

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
    private $userRepo;
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
        $this->userRepo = $usersRepository;
        $this->agencyRepo = $agenciesRepository;
    }

    public function getUser()
    {
        $user = $this->userRepo->fetchUserWithRelations(17);
        return $this->response->respond(['data'=>[
            'user'=>$this->userTransformer->transformDocument($user)
        ]]);
    }

    public function store(AddUserRequest $request)
    {
        $userId = $this->userRepo->storeUser($request->getUserInfo());

        if($userId == null)
            return $this->response->respondInternalServerError();

        if($request->userIsAgent())
            if(!$this->storeAgency($request->getAgencyInfo(), $userId))
                return $this->response->respondInternalServerError();

        $response = [
            'user'=>$this->userTransformer
                ->transformDocument($this->userRepo->getUserDocument($userId))
        ];

        return $this->response->respond($response);
    }

    private function storeAgency(array $agencyInfo, $userId)
    {
        if(!$this->agencyRepo->storeAgency($agencyInfo, $userId))
        {
            $this->userRepo->deleteUser($userId);
            return false;
        }
        return true;
    }

}
