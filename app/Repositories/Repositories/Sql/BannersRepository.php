<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Banners\BannersFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersPages\BannersPagesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSizes\BannersSizesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSocieties\BannersSocietiesFactory;
use App\DB\Providers\SQL\Models\Banner;
use App\Repositories\Interfaces\Repositories\BannersRepoInterface;


class BannersRepository extends SqlRepository implements BannersRepoInterface
{
    private $factory;
    public $bannerSociety ="";
    public $bannerSizes ="";
    public $bannerPages ="";
    public function __construct()
    {
         $this->factory = new BannersFactory();
        $this->bannerSociety = new BannersSocietiesFactory();
        $this->bannerSizes = new BannersSizesFactory();
        $this->bannerPages = new BannersPagesFactory();

    }
    public function getBanners($params)
    {
        return $this->factory->getBanners($params);
    }
    public function saveBanner(Banner $banner)
    {
        return $this->factory->store($banner);
    }
    public function saveSocieties( $societies,$bannerId)
    {
        return $this->bannerSociety->saveSocieties( $societies,$bannerId);
    }
    public function saveBannerSizes($bannerId,$area,$unit)
    {
        return $this->bannerSizes->saveBannerSizes($bannerId,$area,$unit);
    }
    public function saveBannerPages($bannerId,$pageIds)
    {
        return $this->bannerPages->saveBannerPages($bannerId,$pageIds);
    }
}