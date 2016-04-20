<?php

namespace App\DB\Providers\SQL\Factories\Factories\Property;

/**
 * Created by PhpStorm.
 * User: noman
 * Date: 4/6/2016
 * Time: 9:58 AM
 */

use App\DB\Providers\SQL\Factories\Factories\Property\Gateways\PropertyQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;

use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyType;

class PropertyFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertyType();
        $this->tableGateway = new PropertyQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    public function update(PropertyType $propertyType)
    {
        $propertyType->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($propertyType->id ,$this->mapPropertyOnTable($propertyType));
    }

    public function store(Property $property)
    {
        $property->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyOnTable($property));
    }

    public function delete(PropertyType $propertyType)
    {
        return $this->tableGateway->delete($propertyType->id);
    }

    private function mapPropertyOnTable(Property $property)
    {
        return [
            'purpose_id'=>$property->purposeId,
            'property_sub_type_id' => $property->subTypeId,
            'block_id' => $property->blockId,
            'title' => $property->title,
            'description' => $property->description,
            'price' => $property->price,
            'land_area' => $property->landArea,
            'land_unit_id' => $property->landUnitId,
            'property_status_id' => $property->statusId,

            'contact_person' => $property->contactPerson,
            'phone' => $property->phone,
            'mobile' => $property->mobile,
            'email' => $property->email,
            'owner_id'=>$property->ownerId,
            'created_by'=>$property->createdBy,
            'updated_at' => $property->updatedAt,
        ];
    }

    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $property            = new Property();
        $property->id        = $result->id;

        $property->purposeId = $result->purpose_id;
        $property->subTypeId =  $result->sub_type_id;
        $property->blockId =  $result->block_id;
        $property->title =  $result->title;
        $property->description =  $result->description;
        $property->price =  $result->price;
        $property->landArea =  $result->land_area;
        $property->landUnitId =  $result->land_unit_id;

        $property->contactPerson =  $result->contact_person;
        $property->phone =  $result->phone;
        $property->mobile =  $result->mobile;
        $property->email =  $result->email;
        $property->ownerId = $result->owner_id;
        $property->createdBy = $result->created_by;

        $property->createdAt = $result->created_at;
        $property->updatedAt = $result->updated_at;

        return $property;
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