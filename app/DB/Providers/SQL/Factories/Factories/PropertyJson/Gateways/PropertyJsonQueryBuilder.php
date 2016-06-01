<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways;


use App\DB\Providers\SQL\Factories\Factories\Agency\AgencyFactory;
use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\AgencyStaffFactory;
use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways\Helpers\UserPropertiesHelper;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\DB\Providers\SQL\Factories\Factories\User\UserFactory;
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
        $propertyJsonTable = (new PropertyJsonFactory())->getTable();
        $userTable = (new UserFactory())->getTable();
        $agencyStaff = (new AgencyStaffFactory())->getTable();
        $agencyTable = (new AgencyFactory())->getTable();

        return DB::table($table)
            ->leftjoin($propertyJsonTable,$table.'.id','=',$propertyJsonTable.'.property_id')
            ->leftjoin($userTable,$table.'.owner_id','=',$userTable.'.id')
            ->leftjoin($agencyStaff,$userTable.'.id','=',$agencyStaff.'.user_id')
            ->leftjoin($agencyTable,$agencyStaff.'.agency_id','=',$agencyTable.'.id')
            ->select($propertyJsonTable.'.json')
            ->where($conditions)
            ->orderBy($table.'.'.$sort['sortOn'],$sort['sortBy'])
            ->skip($limit['start'])->take($limit['limit'])
            ->distinct()
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