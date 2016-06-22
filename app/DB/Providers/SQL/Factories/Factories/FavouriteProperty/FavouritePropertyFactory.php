<?php

namespace App\DB\Providers\SQL\Factories\Factories\FavouriteProperty;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\City\Gateways\CityQueryBuilder;
use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\Gateways\FavouritePropertyQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\FavouriteProperty;

class FavouritePropertyFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new City();
        $this->tableGateway = new FavouritePropertyQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    public function store(FavouriteProperty $favouriteProperty)
    {
        $favouriteProperty->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapFavouritePropertyOnTable($favouriteProperty));
    }

    private function mapFavouritePropertyOnTable(FavouriteProperty $favouriteProperty)
    {
        return [
            'property_id' => $favouriteProperty->propertyId,
            'user_id'=>$favouriteProperty->userId,
            'updated_at' => $favouriteProperty->updatedAt,
        ];
    }

    function map($result)
    {
        $favourite  = new FavouriteProperty();
        $favourite->id = $result->id;
        $favourite->propertyId = $result->property_id;
        $favourite->userId= $result->user_id;
        $favourite->createdAt = $result->created_at;
        $favourite->updatedAt = $result->updated_at;
        return $favourite;
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
}