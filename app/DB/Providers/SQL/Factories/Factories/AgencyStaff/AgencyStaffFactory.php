<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\AgencyStaff;

use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\Gateways\AgencyStaffQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Block;


class AgencyStaffFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Block();
        $this->tableGateway = new AgencyStaffQueryBuilder();
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    public function setTable($table)
    {
         $this->tableGateway->setTable($table);
    }
    public function map($result){}
    public function find($id){}
    public function all(){}
}