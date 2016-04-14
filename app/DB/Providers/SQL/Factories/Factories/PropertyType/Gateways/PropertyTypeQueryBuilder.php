<?php
namespace App\DB\Providers\SQL\Factories\Factories\PropertyType\Gateways;
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class PropertyTypeQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'property_types';
    }

//    public function getBySociety($societyId)
//    {
//        $societyFactory = new SocietyFactory();
//        $societyTable = $societyFactory->getTable();
//        return  DB::table($societyTable)
//                ->leftjoin($this->table,$societyTable.'.city_id','=',$this->table.'.id')
//                ->select($this->table.'.*')
//                ->where($societyTable.'.id','=',$societyId)
//                ->first();
//    }
}