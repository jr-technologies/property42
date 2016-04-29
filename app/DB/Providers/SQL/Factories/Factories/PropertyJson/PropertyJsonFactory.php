<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\PropertyJson;

use App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways\PropertyJsonQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;
use App\Models\Sql\PropertyJson;

class PropertyJsonFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertyJsonPrototype();
        $this->tableGateway = new PropertyJsonQueryBuilder();
    }

    /**
     * @return array UserModel::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    /**
     * @param int $id
     * @return UserJsonPrototype::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->findByUser($id));
    }

    /**
     * @param UserJsonPrototype $user
     * @return bool
     **/
    public function update(UserJsonPrototype $user)
    {
        return $this->tableGateway->updateWhere(['user_id'=>$user->id], $this->mapPropertyOnTable($user));
    }

    /**
     * @param PropertyJsonPrototype $property
     * @return int
     **/
    public function store(PropertyJsonPrototype $property)
    {
        return $this->tableGateway->insert($this->mapPropertyOnTable($property));
    }

    /**
     * @param $result
     * @return UserJsonPrototype::class
     **/
    public function map($result)
    {
        /* @var $propertyJson PropertyJsonPrototype::class */
        $propertyJson = json_decode($result->json);
        $property = $this->model;
        return $property;
    }


    private function mapPropertyOnTable(PropertyJsonPrototype $property)
    {
        return [
            'property_id' => $property->id,
            'json' => $property->encode(),
        ];
    }
}
