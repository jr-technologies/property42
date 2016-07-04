<?php

namespace App\Http\Controllers\Web\Admin;

use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Mail\AgentMailRequest;

use App\Http\Requests\Requests\Mail\ContactUSMailRequest;
use App\Http\Requests\Requests\Mail\MailPropertyToFriendRequest;

use App\Http\Requests\Requests\Mail\MailToAgentRequest;
use App\Http\Requests\Requests\Property\ApprovePropertyRequest;
use App\Http\Requests\Requests\Property\GetAdminPropertyRequest;
use App\Http\Requests\Requests\Property\RejectPropertyRequest;
use App\Http\Requests\Requests\User\ForgetPasswordRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\User\UsersFilesReleaser;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    use PropertyFilesReleaser;
    public $users =null;
    public $response = null;
    public $properties = null;
    public $favouriteFactory=null;
    public $propertiesRepo=null;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->properties = (new PropertiesJsonRepoProvider())->repo();
        $this->propertiesRepo = (new PropertiesRepoProvider())->repo();
        $this->users = (new UsersJsonRepoProvider())->repo();
        $this->favouriteFactory = new FavouritePropertyFactory();
    }
    public function getProperties()
    {
        return $this->response->setView('frontend.admin.pending-properties')->respond(['data'=>[
            'properties'=>$this->properties->getPendingProperties()
        ]]);
    }

    public function getById(GetAdminPropertyRequest $request)
    {
        $loggedInUser = $request->user();
        $property = $this->properties->getById($request->get('propertyId'));
        return $this->response->setView('frontend.admin.property-detail')->respond(['data'=>[
            'isFavourite'=>($loggedInUser == null)?false:$this->favouriteFactory->isFavourite($request->get('propertyId'),$loggedInUser->id),
            'property'=>$this->releaseAllPropertiesFiles([$property])[0],
            'loggedInUser'=>$loggedInUser,
            'user'=>$this->users->find($property->owner->id)
        ]]);

    }

    public function rejectProperty(RejectPropertyRequest $request)
    {
        $this->propertiesRepo->rejectProperty($request->getPropertyModel());
        return redirect('get/property');
    }
    public function approveProperty(ApprovePropertyRequest $request)
    {
       $this->propertiesRepo->approveProperty($request->getPropertyModel());
       return redirect('get/property');
    }
     public function getAgents()
     {
        $this->response->setView('pending-Agents')->respond(['data'=>[
            'agents'=>$this->users->getPendingAgents()
        ]]);
     }
}
