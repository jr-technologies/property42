<?php
namespace App\DB\Providers\SQL\Factories\Factories\Banners\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\BannersPages\BannersPagesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSizes\BannersSizesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSocieties\BannersSocietiesFactory;
use App\DB\Providers\SQL\Factories\Factories\Pages\PagesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\Libs\Helpers\LandArea;
use Illuminate\Support\Facades\DB;
class BannersQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'banners';
    }
    public function getBanners($params)
    {
        $bannerSocietiesTable = (new BannersSocietiesFactory())->getTable();
        $bannerSizeTable = (new BannersSizesFactory())->getTable();
        $bannerPages = (new BannersPagesFactory())->getTable();
        $pagesTable = (new PagesFactory())->getTable();
        $landUnit = $this->getLandUnit($params);
        $bannerLimit = $this->getBannersLimit($params);


         $query =  DB::table($this->table)
            ->leftjoin($bannerSocietiesTable,$this->table.'.id','=',$bannerSocietiesTable.'.banner_id')
            ->leftjoin($bannerSizeTable,$this->table.'.id','=',$bannerSizeTable.'.banner_id')
             ->leftjoin($bannerPages,$this->table.'.id','=',$bannerPages.'.banner_id')
             ->leftjoin($pagesTable,$bannerPages.'.page_id','=',$pagesTable.'.id')
            ->select($this->table.'.*');

        $query = $query->orWhere(function ($query)  use ($bannerSocietiesTable, $bannerSizeTable, $landUnit, $params) {
            if(isset($params['societyId']) && $params['societyId'] !=null && $params['societyId'] !="")
                $query = $query->orWhere($bannerSocietiesTable.'.society_id','=',$params['societyId']);
            $query = $query->orWhere(function ($query) use ($bannerSizeTable, $landUnit, $params) {
                if(isset($params['landAreaFrom']) && $params['landAreaFrom'] !=null && $params['landAreaFrom'] != "")
                    $query = $query->where($bannerSizeTable.'.area','>=',LandArea::convert($landUnit,'square feet',$params['landAreaFrom']));
                if(isset($params['landAreaTo']) && $params['landAreaTo'] !=null && $params['landAreaTo'] !="")
                    $query = $query->where($bannerSizeTable.'.area','<=',LandArea::convert($landUnit,'square feet',$params['landAreaTo']));
                return $query;
            });
            return $query;
        });
        if(isset($params['bannerType']) && $params['bannerType'] !=null && $params['bannerType'] !="")
          $query =  $query->where($this->table.'.banner_type','=',$params['bannerType']);

        if(isset($params['page']) && $params['page'] !=null && $params['page'] !="")
            $query =  $query->where($pagesTable.'.page','=',$params['page']);

        $query = $query->orderBy($this->table.'.banner_priority', 'DESC');
        $query = $query->skip(0)->take($bannerLimit);
         $query = $query->groupBy($this->table.'.id');
         $query = $query->get();
        return $query;
    }
    public function getLandUnit($params)
    {
        if(isset($params['landUnitId']) && $params['landUnitId'] !=null && $params['landUnitId'] !="")
        return config('constants.LAND_UNITS')[$params['landUnitId']];
        return null;
    }
    public function getBannersLimit($params)
    {
        if(isset($params['position']) && $params['position'] !=null && $params['position'] !="")
            return config('constants.Banners_Limit')[$params['page']][$params['position']];

            return  config('constants.defaultBannerLimit');
    }
}