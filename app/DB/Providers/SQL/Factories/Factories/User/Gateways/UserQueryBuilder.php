<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\User\Gateways;


use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\DB\Providers\SQL\Models\User;
use Illuminate\Support\Facades\DB;

class UserQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "users";
    }
}