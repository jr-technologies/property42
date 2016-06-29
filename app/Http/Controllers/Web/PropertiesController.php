<?php

namespace App\Http\Controllers\Web;

use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\AddToFavourite\AddToFavouriteRequest;
use App\Http\Requests\Requests\Property\GetPropertyRequest;
use App\Http\Requests\Requests\Property\SearchPropertiesRequest;
use App\Http\Requests\Requests\Property\UpdatePropertyRequest;
use App\Http\Requests\Requests\User\GetAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\SearchEngines\Properties\Engines\Cheetah;
use App\Repositories\Providers\Providers\BlocksRepoProvider;
use App\Repositories\Providers\Providers\LandUnitsRepoProvider;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use App\Transformers\Response\PropertyTransformer;
use Illuminate\Support\Facades\DB;

class PropertiesController extends Controller
{
    use PropertyFilesReleaser;
    public $PropertyTransformer = null;
    public $properties = "";
    public $societies =null;
    public $blocks =null;
    public $propertyTypes = null;
    public $propertySubtypes =null;
    public $landUnits =null;
    public $propertyStatuses =null;
    public $favouriteFactory =null;
    public $users = null;


    public function __construct(WebResponse $webResponse, PropertyTransformer $propertyTransformer)
    {
        $this->response = $webResponse;
        $this->PropertyTransformer = $propertyTransformer;

        $this->properties = (new PropertiesJsonRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->blocks = (new BlocksRepoProvider())->repo();
        $this->propertyTypes = (new PropertyTypesRepoProvider())->repo();
        $this->propertySubtypes = (new PropertySubTypesRepoProvider())->repo();
        $this->landUnits = (new LandUnitsRepoProvider())->repo();
        $this->favouriteFactory = new FavouritePropertyFactory();
        $this->users = (new UsersJsonRepoProvider())->repo();
    }

    public function update(UpdatePropertyRequest $request)
    {
        return $this->response
            ->setView('userRegistered')
            ->respond($this->PropertyTransformer->transform($request->all()));
    }

    public function search(SearchPropertiesRequest $request)
    {
        $properties = $this->properties->search($request->getParams());
        $totalPropertiesFound = (new Cheetah())->count();
        return $this->response->setView('frontend.property_listing')->respond(['data' => [
            'properties' => $this->releaseAllPropertiesFiles($properties),
            'totalProperties'=> $totalPropertiesFound[0]->total_records,
            'societies'=>$this->societies->all(),
            'propertyTypes'=>$this->propertyTypes->all(),
            'propertySubtypes'=>$this->propertySubtypes->all(),
            'landUnits'=>$this->landUnits->all(),
            'oldValues'=>$request->all()
        ]]);
    }

    public function index()
    {
        return $this->response->setView('frontend.index')->respond(['data' => [
            'societies'=>$this->societies->all(),
            'propertyTypes'=>$this->propertyTypes->all(),
            'propertySubtypes'=>$this->propertySubtypes->all(),
            'landUnits'=>$this->landUnits->all()
        ]]);
    }
    public function getById(GetPropertyRequest $request)
    {
        $loggedInUser = $request->user();
        $property = $this->properties->getById($request->get('propertyId'));
        return $this->response->setView('frontend.property_detail')->respond(['data'=>[
            'isFavourite'=>($loggedInUser == null)?false:$this->favouriteFactory->isFavourite($request->get('propertyId'),$loggedInUser->id),
            'property'=>$this->releaseAllPropertiesFiles([$property])[0],
            'loggedInUser'=>$loggedInUser,
             'user'=>$this->users->find($property->owner->id)
        ]]);

    }


}
