<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways;


use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways\Helpers\UserPropertiesHelper;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class PropertyJsonQueryBuilder extends QueryBuilder{
    use UserPropertiesHelper;
    public function __construct(){
        $this->table = "property_json";
    }
    public function findByProperty($id)
    {
        return DB::table($this->table)->where('property_id','=',$id)->first();
    }

    public function getUserProperties($params)
    {
            $conditions =$this->computeUserPropertiesParams($params);
            $limit = $this->getLimit($params);
            $sort = $this->sortBy($params);
            $table = (new PropertyFactory())->getTable();
            return DB::table($table)
            ->leftjoin($this->table,$this->table.'.property_id','=',$table.'.id')
            ->select($this->table.'.json')
            ->where($conditions)
            ->orderBy($table.'.'.$sort['sortOn'],$sort['sortBy'])
            ->skip($limit['start'])->take($limit['limit'])
            ->get();
    }

    public function countSearchedUserProperties($params)
    {
        $conditions =$this->computeUserPropertiesParams($params);
        $table = (new PropertyFactory())->getTable();
         return DB::table($table)
            ->leftjoin($this->table,$this->table.'.property_id','=',$table.'.id')
            ->select($this->table.'.json')
            ->where($conditions)
            ->count();
    }
}