<?php

/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\City;
class CityFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new City();
        $this->tableGateway = new CityQueryBuilder();
    }

    function map($result)
    {
        $city = $this->model;
        $city->id = $result->id;
        $city->name = $result->city;
        $city->createdAt = $result->created_at;
        $city->updatedAt = $result->updated_at;
    }
    function find($id)
    {

    }
    function all()
    {

    }

}