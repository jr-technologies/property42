<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\UserJson\Gateways;


use App\DB\Providers\SQL\Factories\Factories\Agency\AgencyFactory;
use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\AgencyStaffFactory;
use App\DB\Providers\SQL\Factories\Factories\User\UserFactory;
use App\DB\Providers\SQL\Factories\Factories\UserRole\UserRolesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use Illuminate\Support\Facades\DB;

class UserJsonQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "user_json";
    }

    public function findByUser($id)
    {
        return DB::table($this->table)->where('user_id','=',$id)->first();
    }


    public function getStaffByOwner($userId)
    {
        $agencyStaffTable = (new AgencyStaffFactory())->getTable();
        $usersTable = (new UserFactory())->getTable();
        $agenciesTable = (new AgencyFactory())->getTable();

        return DB::table($agenciesTable)
            ->rightjoin($agencyStaffTable,$agenciesTable.'.id','=',$agencyStaffTable.'.agency_id')
            ->leftjoin($usersTable,$agencyStaffTable.'.user_id','=',$usersTable.'.id')
            ->leftjoin($this->table,$usersTable.'.id','=',$this->table.'.user_id')
            ->select($this->table.'.*')
            ->where($agenciesTable.'.user_id','=',$userId )
            ->get();
    }

    public function search($params)
    {
        $userTable = (new UserFactory())->getTable();
        $userRoleTable = (new UserRolesFactory())->getTable();

        $query = DB::table($userTable)
            ->leftjoin($userRoleTable,$userTable.'.id','=',$userRoleTable.'.user_id')
            ->leftjoin($this->table,$userTable.'.id','=',$this->table.'.user_id')
            ->select($this->table.'.json')
            ->distinct();
        if (isset($params['userRole']) && $params['userRole'] !=null && $params['userRole'] !="")
            $query = $query->where($userRoleTable.'.role_id',$params['userRole']);
       return  $query = $query->get();
    }


    public function trustedAgents()
    {
        $userTable = (new UserFactory())->getTable();
        $userRoleTable = (new UserRolesFactory())->getTable();

        $query = DB::table($userTable)
            ->leftjoin($userRoleTable,$userTable.'.id','=',$userRoleTable.'.user_id')
            ->leftjoin($this->table,$userTable.'.id','=',$this->table.'.user_id')
            ->select($this->table.'.json')
            ->where($userRoleTable.'.role_id','=',3)
            ->where($userTable.'.trusted_agent','=',1)
            ->distinct();
            return  $query = $query->get();
    }
}