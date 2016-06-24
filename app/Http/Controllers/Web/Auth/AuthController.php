<?php

namespace App\Http\Controllers\Web\Auth;

use App\DB\Providers\SQL\Models\Agency;
use App\Events\Events\User\UserCreated;
use App\Events\Events\User\UserUpdated;
use App\Http\Controllers\Web\WebController;
use App\Http\Requests\Request;
use App\Http\Requests\Requests\Auth\LoginRequest;
use App\Http\Requests\Requests\Auth\RegistrationRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Auth\Web as Authenticator;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Repositories\Repositories\Sql\AgenciesRepository;
use App\Repositories\Repositories\Sql\UsersRepository;
use App\Repositories\Transformers\Sql\UserTransformer;
use App\User;
use Illuminate\Support\Facades\Event;
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
    private $agencies;
    private $roles;
    public function __construct
    (
        WebResponse $response, Authenticator $authenticator,
        UsersRepoProvider $usersRepoProvider, UserTransformer $userTransformer
    )
    {
        $this->roles = (new RolesRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->auth = $authenticator;
        $this->users = $usersRepoProvider->repo();
        $this->response = $response;
        $this->userTransformer = $userTransformer;
        $this->agencies = (new AgenciesRepoProvider())->repo();
    }
    public function showLoginPage()
    {
        if(\Session::has('authUser'))
            return redirect()->route('dashboard');
        return $this->response->setView('auth.login')->respond([]);
    }

    public function login(LoginRequest $request)
    {
        if(!$this->auth->attempt($request->getCredentials())){
            return $this->response->respondInvalidCredentials();
        }

        $authenticatedUser = $this->auth->login($this->users->findByEmail($request->get('email')));
        if($authenticatedUser == null)
            $this->response->respondInternalServerError();

        return redirect()->route('dashboard');
    }

    public function showRegisterPage()
    {
        return $this->response->setView('auth.register')->respond([
            'roles' => $this->roles->all(),
            'societies' => $this->societies->all()
        ]);
    }

    public function register(RegistrationRequest $request)
    {
        $userId = $this->saveUser($request);
        if($request->userIsAgent())
        {
            $this->saveUserAgency($request, $userId);
        }
        $user = $request->getUserModel();
        $user->id = $userId;
        Event::fire(new UserCreated($user));

        \Session::flash('success', 'Registered Successfully');
        return redirect()->route('loginPage');
    }

    private function saveUser(RegistrationRequest $request)
    {
        $userId = $this->users->store($request->getUserModel());
        $this->users->addRoles($userId, $request->getUserRoles());
        return $userId;
    }

    private function saveUserAgency(RegistrationRequest $request, $userId)
    {
        $agency = $request->getAgencyModel();
        $agency->userId = $userId;
        $logoPath = null;
        if($request->hasCompanyLogo()){
            $logoPath = $this->saveLogo($agency, $request->getCompanyLogo());
        }
        $agency->logo = $logoPath;
        $agencyId = $this->agencies->storeAgency($agency);
        $this->agencies->addSocieties($request->getAgencySocieties($agencyId));
        return $agencyId;
    }

    private function saveLogo(Agency $agency, $logo)
    {
        $newName = $this->getCompanyLogoName($agency, $logo);
        $logo->move($this->getCompanyLogoStoragePath($agency), $newName);
        return $this->inStorageLogoPath($agency).'/'.$newName;
    }

    private function getCompanyLogoName(Agency $agency, $logo)
    {
        return md5($agency->name).'.'.$logo->getClientOriginalExtension();
    }

    private function getCompanyLogoStoragePath(Agency $agency)
    {
        return storage_path('app/'.$this->inStorageLogoPath($agency).'/');
    }

    private function inStorageLogoPath(Agency $agency)
    {
        return 'users/'.md5($agency->userId).'/agencies/'.md5($agency->name);
    }
}
