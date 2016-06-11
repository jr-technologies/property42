<?php
namespace App\DB\Providers\SQL\Factories\Factories\Property\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Block\BlockFactory;
use App\DB\Providers\SQL\Factories\Factories\City\CityFactory;
use App\DB\Providers\SQL\Factories\Factories\Country\CountryFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class PropertyQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'properties';
    }

    public function getCompleteLocation($propertyId)
    {
        $blocks = (new BlockFactory())->getTable();
        $societies = (new SocietyFactory())->getTable();
        $cities = (new CityFactory())->getTable();
        $countries = (new CountryFactory())->getTable();
        return  DB::table($this->table)
            ->leftjoin($blocks,$this->table.'.block_id','=',$blocks.'.id')
            ->leftjoin($societies,$blocks.'.society_id','=',$societies.'.id')
            ->leftjoin($cities,$societies.'.city_id','=',$cities.'.id')
            ->leftjoin($countries,$cities.'.country_id','=',$countries.'.id')
            ->select(
                $countries.'.id as countryId',$countries.'.country as countryName',
                $cities.'.id as cityId',$cities.'.city as cityName',
                $societies.'.id as societyId',$societies.'.society as societyName',
                $blocks.'.id as blockId',$blocks.'.block as blockName'
            )
            ->where($this->table.'.id','=',$propertyId)
            ->first();
    }

    public function countProperties($userId)
    {
        $propertyJsonTable = (new PropertyJsonFactory())->getTable();
        return DB::table($this->table)
            ->join($propertyJsonTable,$this->table.'.id','=',$propertyJsonTable.'.property_id')
            ->selectRaw('purpose_id, property_status_id, count('.$this->table.'.id) as totalPropertiesByStatus')
            ->where('owner_id','=',$userId)
            ->groupBy('purpose_id', 'property_status_id')
            ->get();
    }

}