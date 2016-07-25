<?php

namespace App\Http\Controllers\Web\Admin;

use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Property\ApprovePropertyRequest;
use App\Http\Requests\Requests\Property\GetAdminPropertyRequest;
use App\Http\Requests\Requests\Property\GetAdminsPropertiesRequest;
use App\Http\Requests\Requests\Property\RejectPropertyRequest;
use App\Http\Requests\Requests\Property\VerifyPropertyRequest;
use App\Http\Requests\Requests\User\ApproveAgentRequest;
use App\Http\Requests\Requests\User\GetAdminAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;

class AdminController extends Controller
{
    use PropertyFilesReleaser, PropertyPriceUnitHelper;
    public $users =null;
    public $response = null;
    public $properties = null;
    public $favouriteFactory=null;
    public $propertiesRepo=null;
    public $usersRepo = null;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->properties = (new PropertiesJsonRepoProvider())->repo();
        $this->propertiesRepo = (new PropertiesRepoProvider())->repo();
        $this->users = (new UsersJsonRepoProvider())->repo();
        $this->usersRepo = (new UsersRepoProvider())->repo();
        $this->favouriteFactory = new FavouritePropertyFactory();
    }
    public function getProperties(GetAdminsPropertiesRequest $request)
    {
        $properties = $this->properties->getPendingProperties();
        return $this->response->setView('admin.pending-properties')->respond(['data'=>[
            'properties'=>$properties,
            'propertiesCount'=>count($properties)
        ]]);
    }

    public function getById(GetAdminPropertyRequest $request)
    {
        $loggedInUser = $request->user();
        $property = $this->convertPropertyAreaToActualUnit($this->properties->getById($request->get('propertyId')));
        return $this->response->setView('admin.property-detail')->respond(['data'=>[
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
    public function VerifyProperty(VerifyPropertyRequest $request)
    {
        $this->propertiesRepo->VerifyProperty($request->getPropertyModel());
        return redirect('get/property');
    }

    public function approveProperty(ApprovePropertyRequest $request)
    {
       $this->propertiesRepo->approveProperty($request->getPropertyModel());
       return redirect('get/property');
    }
     public function getAgents()
     {
         $agents = $this->users->getPendingAgents();
        return $this->response->setView('admin.pending-Agents')->respond(['data'=>[
            'agents'=>$agents,
             'agentsCount'=>count($agents)
        ]]);
     }
    public function approveAgent(ApproveAgentRequest $request)
    {
         $this->usersRepo->approveAgent($request->getUserModel());
        return redirect('admin/agents');
}
    public function getAgent(GetAdminAgentRequest $request)
    {
       return $this->response->setView('admin.Agent_profile')->respond(['data'=>[
            'agent'=>$this->users->find($request->get('userId'))]]);
    }
}
