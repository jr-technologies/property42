<?php

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\Feature;

use App\DB\Providers\SQL\Factories\Factories\Feature\Gateways\FeatureQueryBuilder;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\AppMessage;
use App\DB\Providers\SQL\Models\Features\Feature;
use App\DB\Providers\SQL\Models\Features\FeatureWithValidationRules;
use App\DB\Providers\SQL\Models\Features\PropertyFeatureValueAndSection;
use App\DB\Providers\SQL\Models\FeatureSection;
use App\DB\Providers\SQL\Models\ValidationRules\ValidationRuleWithErrorMessage;

class FeatureFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Feature();
        $this->tableGateway = new FeatureQueryBuilder();
    }

    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    public function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    public function getBySubType($subTypeId)
    {
        return $this->mapCollection($this->tableGateway->getBySubType($subTypeId));
    }

    public function update(Feature $feature)
    {
        $feature->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($feature->id ,$this->mapFeatureOnTable($feature));
    }

    public function store(Feature $feature)
    {
        $feature->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapFeatureOnTable($feature));
    }

    public function delete(Feature $feature)
    {
        return $this->tableGateway->delete($feature->id);
    }

    public function assignedFeaturesWithValidationRules($subTypeId)
    {
        $rawFeatures = $this->tableGateway->assignedFeaturesWithValidationRules($subTypeId);
        return $this->mapAssignedFeaturesWithValidationRules($rawFeatures);
    }

    private function mapAssignedFeaturesWithValidationRules($rawFeatures)
    {
        $collection = collect($rawFeatures);
        $grouped = $collection->groupBy('featureId');
        $groupedFeaturesArray = $grouped->toArray();
        $featuresWithValidationRules = [];
        foreach($groupedFeaturesArray as $featureId => $features)
        {
            $featureWithValidationRules = new FeatureWithValidationRules();
            $featureWithValidationRules->featureId = $features[0]->featureId;
            $featureWithValidationRules->featureName = $features[0]->featureName;
            $featureWithValidationRules->featureInputName = $features[0]->featureInputName;
            $featureWithValidationRules->priority = $features[0]->featurePriority;

            /* mapping rules with message */
            $featureRules = [];
            foreach($features as $feature)
            {
                if($feature->ruleId != null)
                {
                    $validationRuleWithErrors = new ValidationRuleWithErrorMessage();
                    $validationRuleWithErrors->ruleId = $feature->ruleId;
                    $validationRuleWithErrors->name = $feature->ruleName;

                    $validationErrorMessage = new AppMessage();
                    $validationErrorMessage->id = $feature->appMessageId;
                    $validationErrorMessage->shortMessage = $feature->shortMessage;
                    $validationErrorMessage->longMessage = $feature->longMessage;

                    if($validationErrorMessage->id != null)
                        $validationRuleWithErrors->errorMessage = $validationErrorMessage;

                    $featureRules[] = $validationRuleWithErrors;
                }
            }
            $featureWithValidationRules->validationRules = $featureRules;

            $featuresWithValidationRules[] = $featureWithValidationRules;
        }

        return $featuresWithValidationRules;
    }


    /**
     * @param int $propertyId
     * @return array
     * Desc: below function returns all given features of a property
     *          with sections
     * */
    public function getAPropertyFeaturesWithValues($propertyId)
    {
        return $this->mapAPropertyFeaturesWithValues($this->tableGateway->getAPropertyFeaturesWithValues($propertyId));
    }

    private function mapAPropertyFeaturesWithValues($features)
    {
        $finalFeatures = [];
        foreach($features as $feature)
        {
            $featureWithValueAndSection = new PropertyFeatureValueAndSection();
            $featureWithValueAndSection->featureId = $feature->featureId;
            $featureWithValueAndSection->featureName = $feature->featureName;
            $featureWithValueAndSection->featureInputName = $feature->featureInputName;
            $featureWithValueAndSection->possibleValues = $feature->possibleValues;
            $featureWithValueAndSection->propertyId = $feature->propertyId;
            $featureWithValueAndSection->value = $feature->value;

            $section = new FeatureSection();
            $section->id = $feature->sectionId;
            $section->name = $feature->sectionName;

            $featureWithValueAndSection->section = $section;

            $finalFeatures[] = $featureWithValueAndSection;
        }
        return $finalFeatures;
    }

    private function mapFeatureOnTable(Feature $feature)
    {
        return [
            'id'=>$feature->id,
            'feature_section_id'=>$feature->priority,
            'feature'=>$feature->name,
            'input_name'=>$feature->inputName,
            'html_structure_id'=>$feature->htmlStructureId,
            'possible_values'=>$feature->possibleValues,

            'updated_at' => $feature->updatedAt,
        ];
    }

    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $feature = new Feature();

        $feature->id = $result->id;
        $feature->name = $result->feature;
        $feature->inputName = $result->input_name;
        $feature->htmlStructureId = $result->html_structure_id;
        $feature->possibleValues = $result->possible_values;
        $feature->priority = $result->priority;
        $feature->featureSectionId = $result->feature_section_id;

        $feature->createdAt = $result->created_at;
        $feature->updatedAt = $result->updated_at;
        return $feature;
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