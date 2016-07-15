<?php

namespace App\Http\Controllers\Web\Admin;

use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Requests\Property\ApprovePropertyRequest;
use App\Http\Requests\Requests\Property\GetAdminPropertyRequest;
use App\Http\Requests\Requests\Property\RejectPropertyRequest;
use App\Http\Requests\Requests\User\ApproveAgentRequest;
use App\Http\Requests\Requests\User\GetAdminAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\AdminsRepoProvider;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;

class AuthController extends Controller
{
    use PropertyFilesReleaser;
    public $adminRepo = null;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->adminRepo = (new AdminsRepoProvider())->repo();
    }
    public function getLoginPage()
    {
        return $this->response->setView('admin.auth.login')->respond(['data'=>'']);
    }
    public function login(AdminLoginRequest $request)
    {
         $admin = $this->adminRepo->getAdmin($request->getCredentials());
        if(sizeof($admin) >0)
        {
            return redirect('admin/agents');
        }
    }
}
