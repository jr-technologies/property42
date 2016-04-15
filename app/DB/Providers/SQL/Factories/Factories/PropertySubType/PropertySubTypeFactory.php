<?php

namespace App\DB\Providers\SQL\Factories\Factories\PropertySubType;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */

use App\DB\Providers\SQL\Factories\Factories\PropertySubType\Gateways\PropertySubTypeQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\PropertySubType;

class PropertySubTypeFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertySubType();
        $this->tableGateway = new PropertySubTypeQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }
    public function update(PropertySubType $propertySubType)
    {
        $propertySubType->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($propertySubType->id ,$this->mapPropertyTypeOnTable($propertySubType));
    }
    public function store(PropertySubType $propertySubType)
    {
        $propertySubType->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyTypeOnTable($propertySubType));
    }
    public function delete(PropertySubType $propertySubType)
    {
        return $this->tableGateway->delete($propertySubType->id);
    }
    private function mapPropertyTypeOnTable(PropertySubType $propertySubType)
    {
        return [
            'sub_type'=>$propertySubType->name,
            'property_type_id'=>$propertySubType->propertyTypeId,
            'updated_at' => $propertySubType->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $propertySubType = $this->model;
        $propertySubType->id=$result->id;
        $propertySubType->name= $result->sub_type;
        $propertySubType->propertyTypeId= $result->property_type_id;
        $propertySubType->createdAt = $result->created_at;
        $propertySubType->updatedAt = $result->updated_at;
        return $propertySubType;
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