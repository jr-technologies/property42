<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Web\WebController;
use App\Http\Requests\Request;
use App\Http\Requests\Requests\Auth\LoginRequest;
use App\Http\Requests\Requests\Auth\RegistrationRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Auth\Web as Authenticator;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Repositories\Transformers\Sql\UserTransformer;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends WebController
{
    private $auth;
    private $users;
    private $userTransformer;
    public $response;
    public function __construct
    (
        WebResponse $response, Authenticator $authenticator,
        UsersRepoInterface $usersRepository, UserTransformer $userTransformer
    )
    {
        $this->auth = $authenticator;
        $this->users = $usersRepository;
        $this->response = $response;
        $this->userTransformer = $userTransformer;
    }
    public function showLoginPage()
    {
        return $this->response->setView('loginPage')->respond([]);
    }

    public function login(LoginRequest $request)
    {

        if(!$this->auth->attempt($request->getCredentials())){
            return $this->response->respondInvalidCredentials();
        }

        $authenticatedUser = $this->auth->login(['email'=>$request->getCredentials()['email']]);
        if($authenticatedUser == null)
            $this->response->respondInternalServerError();

        return $this->response->setView('welcome')->respond(['data'=>[
            'authUser' => $authenticatedUser
        ]]);
    }

    public function showRegisterPage()
    {
        return $this->response->setView('register')->respond([]);
    }
    public function register(RegistrationRequest $request)
    {
        $userId = $this->users->store($request->getUserInfo());

        if($userId == null)
            return $this->response->respondInternalServerError();

        return redirect()->back();
    }
}
