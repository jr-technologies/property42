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

    public function delete($id)
    {
        return $this->tableGateway->deleteWhere(['property_id'=>$id]);
    }
    /**
     * @param $params
     * @return mixed
     */
    public function getUserProperties($params)
    {
        return $this->mapCollection($this->tableGateway->getUserProperties($params));
    }
    public function countSearchedUserProperties($params)
    {
         return $this->tableGateway->countSearchedUserProperties($params);
    }
    /**
     * @param PropertyJsonPrototype $property
     * @return bool
     **/
    public function update(PropertyJsonPrototype $property)
    {
        return $this->tableGateway->updateWhere(['property_id'=>$property->id], $this->mapPropertyOnTable($property));
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
        $property = clone($this->model);

        $property->id = $propertyJson->id;
        $property->owner = $propertyJson->owner;
        $property->type = $propertyJson->type;
        $property->totalViews = $propertyJson->totalViews;
        $property->totalLikes = $propertyJson->totalLikes;
        $property->title = $propertyJson->title;
        $property->rating = $propertyJson->rating;
        $property->purpose = $propertyJson->purpose;
        $property->propertyStatus = $propertyJson->propertyStatus;
        $property->price = $propertyJson->price;
        $property->location = $propertyJson->location;
        $property->isHot = $propertyJson->isHot;
        $property->land = $propertyJson->land;
        $property->isFeatured = $propertyJson->isFeatured;
        $property->isDeleted = $propertyJson->isDeleted;
        $property->features = $propertyJson->features;
        $property->description = $propertyJson->description;
        $property->createdBy = $propertyJson->createdBy;
        return $property;
    }

    /**
     * @param PropertyJsonPrototype $property
     * @return array
     */
    private function mapPropertyOnTable(PropertyJsonPrototype $property)
    {
        return [
            'property_id' => $property->id,
            'json' => $property->encode(),
        ];
    }
}
