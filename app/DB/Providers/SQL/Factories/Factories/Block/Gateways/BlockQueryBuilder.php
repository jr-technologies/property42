<?php
namespace App\DB\Providers\SQL\Factories\Factories\Block\Gateways;
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class BlockQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'blocks';
    }




}