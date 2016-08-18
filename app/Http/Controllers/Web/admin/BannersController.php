<?php

namespace App\Http\Controllers\Web\Admin;

use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Admin\GetAdminActivePropertyRequest;
use App\Http\Requests\Requests\Admin\GetAdminDeletedPropertyRequest;
use App\Http\Requests\Requests\Admin\GetAdminExpiredPropertyRequest;
use App\Http\Requests\Requests\Admin\GetAdminPendingPropertyRequest;
use App\Http\Requests\Requests\Admin\GetAdminRejectedPropertyRequest;
use App\Http\Requests\Requests\Banners\AddBannerRequest;
use App\Http\Requests\Requests\Banners\GetAllBannersRequest;
use App\Http\Requests\Requests\Block\AddBlockRequest;
use App\Http\Requests\Requests\Block\DeleteBlockRequest;
use App\Http\Requests\Requests\Block\GetUpdateBlockFormRequest;
use App\Http\Requests\Requests\Block\UpdateBlockRequest;
use App\Http\Requests\Requests\Property\ApprovePropertyRequest;
use App\Http\Requests\Requests\Property\DeActivePropertyRequest;
use App\Http\Requests\Requests\Property\DeVerifyPropertyRequest;
use App\Http\Requests\Requests\Property\GetAdminPropertyRequest;
use App\Http\Requests\Requests\Property\GetAdminsPropertiesRequest;
use App\Http\Requests\Requests\Property\RejectPropertyRequest;
use App\Http\Requests\Requests\Property\VerifyPropertyRequest;
use App\Http\Requests\Requests\Society\AddSocietyRequest;
use App\Http\Requests\Requests\Society\DeleteSocietyRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesRequest;
use App\Http\Requests\Requests\Society\GetUpdateSocietyFormRequest;
use App\Http\Requests\Requests\Society\UpdateSocietyRequest;
use App\Http\Requests\Requests\User\ApproveAgentRequest;
use App\Http\Requests\Requests\User\GetAdminAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\BannersRepoProvider;
use App\Repositories\Providers\Providers\BlocksRepoProvider;
use App\Repositories\Providers\Providers\PagesRepoProvider;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;

class BannersController extends Controller
{
    use PropertyFilesReleaser, PropertyPriceUnitHelper;
    public $users = null;
    public $response = null;
    public $societyRepo=null;
    public $pagesRepo = null;
    public $bannersRepo = null;

    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->societyRepo = (new SocietiesRepoProvider())->repo();
        $this->pagesRepo = (new PagesRepoProvider())->repo();
        $this->bannersRepo = (new BannersRepoProvider())->repo();
    }
    public function banners()
    {
        return $this->response->setView('admin.banners.banners')->respond(['data'=>[
            'societies'=>$this->societyRepo->all(),
            'pages'=>$this->pagesRepo->all()
        ]]);
    }

    public function addBanner(AddBannerRequest $request)
    {
        $bannerId = $this->saveBanner($request);
        if($request->get('societiesIds') !=null)
        {
            $this->saveBannerSocieties($request->get('societiesIds'),$bannerId);
        }
        if($request->get('area') !=null)
        {
            $this->saveBannerSizes($bannerId,$request->get('area'),$request->get('unit'));
        }
        if($request->get('pagesIds') !=null)
        {
            $this->saveBannerPages($bannerId,$request->get('pagesIds'));
        }

    }

    public function saveBanner(AddBannerRequest $request)
    {
       return $this->bannersRepo->saveBanner($request->getBannerModel());
    }
    public function saveBannerSocieties(array $societies,$bannerId)
    {
        return $this->bannersRepo->saveSocieties( $societies,$bannerId);
    }
    public function saveBannerSizes($bannerId,$area,$unit)
    {
        return $this->bannersRepo->saveBannerSizes($bannerId,$area,$unit);
    }
    public function saveBannerPages($bannerId,$pageIds)
    {
        return $this->bannersRepo->saveBannerPages($bannerId,$pageIds);
    }
}
