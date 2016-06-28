<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Mail\AgentMailRequest;
use App\Http\Requests\Requests\User\AddUserRequest;
use App\Http\Requests\Requests\User\DeleteUserRequest;
use App\Http\Requests\Requests\User\ForgetPasswordRequest;
use App\Http\Requests\Requests\User\GetAgentRequest;
use App\Http\Requests\Requests\User\GetAgentsRequest;
use App\Http\Requests\Requests\User\SearchUsersRequest;
use App\Http\Requests\Requests\User\TrustedAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Helpers\Helper;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\User\UsersFilesReleaser;
use App\Transformers\Response\UserTransformer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    use UsersFilesReleaser;
    public $userTransformer = null;
    public $usersJsonRepo = null;
    public $users = null;
    public $societies = null;
    public $rand= "";
    public function __construct(WebResponse $webResponse, UserTransformer $userTransformer)
    {
        $this->response = $webResponse;
        $this->users = (new UsersRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->userTransformer = $userTransformer;
        $this->usersJsonRepo = (new UsersJsonRepoProvider())->repo();
        $this->rand = new Helper();
    }

    public function store(AddUserRequest $request)
    {
        return $this->response
            ->setView('userRegistered')
            ->respond($this->userTransformer->transform($request->all()));
    }
    public function forgetPassword()
    {
        return $this->response
            ->setView('auth.forget_password')->respond(['data' => []]);
    }
    public function getNewPassword(ForgetPasswordRequest $request)
    {
        $password  = $this->rand->rands();
        $user = $this->users->findByEmail($request->get('email'));
        $user->password = bcrypt($password);
        $this->users->update($user);
        Mail::send('frontend.mail.forget_password',['user' => $user,'password'=>$password], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Property42.pk');
            $message->to($user->email)->subject('Property42');
        });
        //Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }
    public function trustedAgents(GetAgentsRequest $request)
    {
        $agents = $this->usersJsonRepo->trustedAgents($request->all());
        $totalAgentsFound = \Session::get('totalAgentsFound');
        return $this->response->setView('frontend.agent-listing')->respond(['data' => [
            'agents' => $this->releaseUsersAgenciesLogo($agents),
            'societies'=>$this->societies->all(),
            'params'=>$request->all(),
            'totalAgentsFound' => $totalAgentsFound
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
