<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Society\GetAllSocietiesForMapsRequest;
use App\Http\Requests\Requests\Society\GetSocietyMapsRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Repositories\Sql\SocietiesMapsRepository;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;
use App\Traits\Property\ShowAddPropertyFormHelper;
use App\Transformers\Response\PropertyTransformer;

class SocietiesController extends Controller
{
    use PropertyFilesReleaser, PropertyPriceUnitHelper, ShowAddPropertyFormHelper;
    public $PropertyTransformer = null;
    public $societyMaps = "";
    public $societies = null;

    public function __construct(WebResponse $webResponse, PropertyTransformer $propertyTransformer)
    {
        $this->response = $webResponse;
        $this->PropertyTransformer = $propertyTransformer;
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->societyMaps = new SocietiesMapsRepository();
     }

    public function getAllSocietiesForMaps(GetAllSocietiesForMapsRequest $request)
    {
       return $this->response->setView('frontend.v2.societies')->respond(['data'=>[
           'societies'=>$this->societies->all()
       ]]);
    }

    public function getSocietyMaps(GetSocietyMapsRequest $request)
    {
        return $this->response->setView('frontend.v2.maps')->respond(['data'=>[
            'societiesMaps'=>$this->societyMaps->getSocietyMaps($request->get('societyId'))
        ]]);
    }

}
