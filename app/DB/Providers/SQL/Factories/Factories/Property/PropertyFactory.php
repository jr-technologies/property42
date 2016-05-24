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

use App\DB\Providers\SQL\Models\Block;
use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Country;
use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\Property\PropertyCompleteLocation;
use App\DB\Providers\SQL\Models\PropertyType;
use App\DB\Providers\SQL\Models\Society;

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
    public function delete(Property $property)
    {
        return  $this->tableGateway->delete($property->id);
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }
    public function update(Property $property)
    {
        return $this->tableGateway->update($property->id,$this->mapPropertyOnTable($property));
    }

    public function store(Property $property)
    {
        $property->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyOnTable($property));
    }

    public function getCompleteLocation($propertyId)
    {
        return $this->mapPropertyCompleteLocation($this->tableGateway->getCompleteLocation($propertyId));
    }

    private function mapPropertyCompleteLocation($rawLocation)
    {
        $propertyCompleteLocation = new PropertyCompleteLocation();

        $country = new Country();
        $country->id = $rawLocation->countryId;
        $country->name = $rawLocation->countryName;

        $city = new City();
        $city->id = $rawLocation->cityId;
        $city->name = $rawLocation->cityName;
        $city->countryId = $rawLocation->countryId;

        $society = new Society();
        $society->id = $rawLocation->societyId;
        $society->name = $rawLocation->societyName;
        $society->cityId = $rawLocation->cityId;

        $block = new Block();
        $block->id = $rawLocation->blockId;
        $block->name = $rawLocation->blockName;
        $block->societyId = $rawLocation->societyId;

        $propertyCompleteLocation->country = $country;
        $propertyCompleteLocation->city = $city;
        $propertyCompleteLocation->society = $society;
        $propertyCompleteLocation->block = $block;

        return $propertyCompleteLocation;
    }

    private function mapPropertyOnTable(Property $property)
    {
        return [
            'Id'=>$property->id,
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
        $property->subTypeId =  $result->property_sub_type_id;
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

        $property->statusId = $result->property_status_id;
        $property->totalViews = $result->total_views;
        $property->totalLikes = $result->total_likes;
        $property->ratings = $result->rating;

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

    public function propertiesCounter($properties, $purposeId, $statusId)
    {
        $collection = collect($properties);
        $groupedByPurposeId = $collection->groupBy('purpose_id');
        $propertiesByPurposeCollection = (isset($groupedByPurposeId->all()[$purposeId]))?$groupedByPurposeId->all()[$purposeId]:collect([]);
        $groupedByStatusId = $propertiesByPurposeCollection->groupBy('property_status_id');
        $propertiesByStatusCollection = (isset($groupedByStatusId->all()[$statusId]))?$groupedByStatusId->all()[$statusId]:collect([]);
        return $propertiesByStatusCollection->count();
    }

    public function countProperties($userId)
    {
        $properties = $this->tableGateway->getWhere(['owner_id'=>$userId]);
        $countPropertiesModel = new Property\CountPropertiesModel();
        $propertiesStatusesModel1 = new Property\PropertiesStatusesModel();
        $propertiesStatusesModel1->active = $this->propertiesCounter($properties, 1, 1);
        $propertiesStatusesModel1->expired = $this->propertiesCounter($properties, 1, 6);
        $propertiesStatusesModel1->pending = $this->propertiesCounter($properties, 1, 2);
        $propertiesStatusesModel1->approved = $this->propertiesCounter($properties, 2, 5);
        $propertiesStatusesModel1->deleted = $this->propertiesCounter($properties, 2, 3);
        $propertiesStatusesModel1->rejected = $this->propertiesCounter($properties, 2, 4);
        $countPropertiesModel->forSale = $propertiesStatusesModel1;

        $propertiesStatusesModel2 = new Property\PropertiesStatusesModel();
        $propertiesStatusesModel2->active = $this->propertiesCounter($properties, 2, 1);
        $propertiesStatusesModel2->expired = $this->propertiesCounter($properties, 2, 6);
        $propertiesStatusesModel2->pending = $this->propertiesCounter($properties, 1, 2);
        $propertiesStatusesModel2->approved = $this->propertiesCounter($properties, 2, 5);
        $propertiesStatusesModel2->deleted = $this->propertiesCounter($properties, 2, 3);
        $propertiesStatusesModel2->rejected = $this->propertiesCounter($properties, 2, 4);
        $countPropertiesModel->forRent = $propertiesStatusesModel2;

        return $countPropertiesModel;
    }
}