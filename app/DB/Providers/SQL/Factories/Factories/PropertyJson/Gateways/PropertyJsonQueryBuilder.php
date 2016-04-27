<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways;


use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class PropertyJsonQueryBuilder extends QueryBuilder{
    public function __construct(){
        $this->table = "property_json";
    }

    public function findByProperty($id)
    {
        return DB::table($this->table)->where('property_id','=',$id)->first();
    }
}