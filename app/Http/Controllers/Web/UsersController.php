<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Mail\AgentMailRequest;
use App\Http\Requests\Requests\User\AddUserRequest;
use App\Http\Requests\Requests\User\DeleteUserRequest;
use App\Http\Requests\Requests\User\GetAgentRequest;
use App\Http\Requests\Requests\User\GetAgentsRequest;
use App\Http\Requests\Requests\User\SearchUsersRequest;
use App\Http\Requests\Requests\User\TrustedAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\User\UsersFilesReleaser;
use App\Transformers\Response\UserTransformer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UsersController extends Controller
{
    use UsersFilesReleaser;
    public $userTransformer = null;
    public $usersJsonRepo = null;
    public $users = null;
    public $societies = null;
    public function __construct(WebResponse $webResponse, UserTransformer $userTransformer)
    {
        $this->response = $webResponse;
        $this->users = (new UsersRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->userTransformer = $userTransformer;
        $this->usersJsonRepo = (new UsersJsonRepoProvider())->repo();
    }

    public function store(AddUserRequest $request)
    {
        return $this->response
            ->setView('userRegistered')
            ->respond($this->userTransformer->transform($request->all()));
    }

    public function trustedAgents(GetAgentsRequest $request)
    {
        return $this->response
            ->setView('frontend.agent-listing')->respond(['data' => [
                'agents' => $this->releaseUsersAgenciesLogo($this->usersJsonRepo->trustedAgents($request->all())),
                'societies'=>$this->societies->all(),
                'params'=>$request->all(),
            ]]);
    }

    public function getTrustedAgent(GetAgentRequest $request)
    {
        return $this->response->setView('frontend.agent-profile')->respond(['data' => [
            'agent' => $this->releaseAllUserFiles($this->usersJsonRepo->find($request->get('userId')))
        ]]);
    }
    public function makeTrustedAgent(TrustedAgentRequest $request)
    {
        $user = $request->getUserModel();
        return $this->response->setView('frontend.agent-profile')->respond(['data' => [
            'trustedAgent'=>$this->users->makeTrustedAgent($user)]]);
    }
}
