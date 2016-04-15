<?php
namespace App\DB\Providers\SQL\Factories\Factories\PropertyPurpose\Gateways;
/**
 * Created by WAQAS.
 * User: JR Tech
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;

class PropertyPurposeQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'property_purposes';
    }
}