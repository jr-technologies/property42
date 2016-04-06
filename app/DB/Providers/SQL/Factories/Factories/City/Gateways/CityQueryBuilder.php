<?php

/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;

class CityQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'city';
    }
}