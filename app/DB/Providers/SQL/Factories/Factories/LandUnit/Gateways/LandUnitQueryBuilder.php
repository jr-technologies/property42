<?php
namespace App\DB\Providers\SQL\Factories\Factories\LandUnit\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class LandUnitQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'land_units';
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