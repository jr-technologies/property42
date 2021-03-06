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
use App\DB\Providers\SQL\Models\PropertyPurpose;
use App\DB\Providers\SQL\Models\PropertyStatus;
use App\DB\Providers\SQL\Models\PropertyType;
use App\DB\Providers\SQL\Models\Society;
use App\Repositories\Providers\Providers\PropertyPurposesRepoProvider;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;

class PropertyFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    private $statusesSeeder =null;
    public function __construct()
    {
        $this->model = new PropertyType();
        $this->tableGateway = new PropertyQueryBuilder();
        $this->statusesSeeder = new \PropertyStatusTableSeeder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function delete(Property $property)
    {
        $property->statusId = $this->statusesSeeder->getDeletedStatusId();
        return  $this->tableGateway->updateWhere(['id'=>$property->id],$this->mapPropertyOnTable($property));
    }
    public function forceDelete(Property $property)
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

    public function rawPropertyCounts($userId)
    {
        $propertyCounts = $this->tableGateway->countProperties($userId);
        $propertyCountsCollection = collect($propertyCounts);
        $groupedByPurpose = $propertyCountsCollection->groupBy('purpose_id');
        $finalArray = [];
        $groupedByPurpose->each(function($item, $key) use (&$finalArray){
            $statusesCounts = [];
            $item->each(function($status, $key) use (&$statusesCounts){
                $statusesCounts[$status->property_status_id] = $status->totalPropertiesByStatus;
            });
            $finalArray[$key] = $statusesCounts;
        });
        return $finalArray;
    }

    public function propertiesCounter($propertyCounts, $purpose, $status)
    {

        if(isset($propertyCounts[$purpose][$status]))
        {
            return intval($propertyCounts[$purpose][$status]);
        }
    }
    public function countProperties($userId)
    {
        $rawPropertyCounts = $this->rawPropertyCounts($userId);
        $purposes = (new PropertyPurposesRepoProvider())->repo()->all();
        $statuses = (new PropertyStatusesRepoProvider())->repo()->all();

        $finalCounts = [];
        foreach($purposes as $purpose /* @var $purpose PropertyPurpose::class */)
        {
            $pStatuses = [];
            foreach($statuses as $status /* @var $status PropertyStatus::class */)
            {
                $pStatuses[$status->id] = $this->propertiesCounter($rawPropertyCounts,$purpose->id, $status->id);
            }
            $finalCounts[$purpose->id] = $pStatuses;
        }
        return $finalCounts;
    }
}