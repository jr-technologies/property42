<?php
namespace App\DB\Providers\SQL\Factories\Factories\Society\Gateways;
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;

class SocietyQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'societies';
    }
}