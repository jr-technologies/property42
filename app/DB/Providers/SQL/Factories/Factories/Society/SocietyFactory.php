<?php
namespace App\DB\Providers\SQL\Factories\Factories\Society;
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\Gateways\SocietyQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\City;
class SocietyFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->tableGateway = new SocietyQueryBuilder();
    }
    function map($result){}
    function find($id){}
    function all(){}
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
}