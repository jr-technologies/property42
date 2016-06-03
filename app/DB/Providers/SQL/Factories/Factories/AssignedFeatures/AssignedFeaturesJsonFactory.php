<?php

namespace App\DB\Providers\SQL\Factories\Factories\AssignedFeatures;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\AssignedFeatures\Gateways\AssignedFeaturesQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\AssignedFeatures;
class AssignedFeaturesJsonFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new AssignedFeatures();
        $this->tableGateway = new AssignedFeaturesQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function updateWhere( array $condition,AssignedFeatures $assignedFeatures )
    {
        return $this->tableGateway->updateWhere($condition,$this->mapAssignedFeatureDocumentsOnTable($assignedFeatures));
    }
    /**
     * @return array
     */
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    public function store(AssignedFeatures $assignedFeatures)
    {
        $assignedFeatures->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapAssignedFeatureDocumentsOnTable($assignedFeatures));
    }

    private function mapAssignedFeatureDocumentsOnTable(AssignedFeatures $assignedFeatures)
    {
        return [
            'property_sub_type_id' => $assignedFeatures->subTypeId,
            'document'=>$assignedFeatures->json,
            'updated_at' => $assignedFeatures->updatedAt,
        ];
    }
    function map($result)
    {
        $assignedFeature  = clone(new AssignedFeatures());
        $assignedFeature->id  = $result->id;
        $assignedFeature->subTypeId = $result->property_sub_type_id;
        $assignedFeature->json = $result->document;
        $assignedFeature->createdAt = $result->created_at;
        $assignedFeature->updatedAt = $result->updated_at;
        return $assignedFeature;
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