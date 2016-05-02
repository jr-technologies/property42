<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\UserRole\Gateways;


use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;

class UserRoleQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "user_roles";
    }


}