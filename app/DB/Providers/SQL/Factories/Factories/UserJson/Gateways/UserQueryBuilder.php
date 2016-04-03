<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\UserJson\Gateways;


use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class UserJsonQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "user_json";
    }

    public function findByUser($id)
    {
        $user = DB::table($this->table)->where('user_id','=',$id)->get()->first();
        return json_decode($user->json());
    }
}