<?php

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\Feature\Gateways;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class FeatureQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'property_features';
    }

    public function getBySubType($subTypeId)
    {
        $propertySubTypeAssignedFeatures = 'property_sub_type_assigned_features';
        return  DB::table($propertySubTypeAssignedFeatures)
            ->leftjoin($this->table,$propertySubTypeAssignedFeatures.'.property_feature_id','=',$this->table.'.id')
            ->select($this->table.'.*')
            ->where($propertySubTypeAssignedFeatures.'.property_sub_type_id','=',$subTypeId)
            ->get();
    }


    public function assignedFeaturesWithValidationRules($subTypeId)
    {
        $propertySubTypeAssignedFeatures = 'property_sub_type_assigned_features';
        $assignedFeatureValidations = 'assigned_feature_validations';
        $propertyFeatures = $this->table;
        $validationRules = 'validation_rules';
        $validationErrorMessages = 'validation_error_messages';
        $appMessages = 'app_messages';
        return  DB::table($propertySubTypeAssignedFeatures)
            ->leftjoin($propertyFeatures,$propertySubTypeAssignedFeatures.'.property_feature_id','=',$propertyFeatures.'.id')
            ->leftjoin($assignedFeatureValidations,$propertySubTypeAssignedFeatures.'.id','=',$assignedFeatureValidations.'.property_sub_type_assign_feature_id')
            ->leftjoin($validationRules,$assignedFeatureValidations.'.validation_rule_id','=',$validationRules.'.id')
            ->leftjoin($validationErrorMessages,$validationRules.'.id','=',$validationErrorMessages.'.validation_rule_id')
            ->leftjoin($appMessages,$validationErrorMessages.'.app_message_id','=',$appMessages.'.id')
            ->select(
                $propertyFeatures.'.id as featureId',$propertyFeatures.'.feature as featureName', $propertyFeatures.'.input_name as featureInputName', $propertyFeatures.'.priority as featurePriority',
                $validationRules.'.id as ruleId', $validationRules.'.rule as ruleName',
                $appMessages.'.id as appMessageId', $appMessages.'.short_message as shortMessage', $appMessages.'.long_message as longMessage'
            )
            ->where($propertySubTypeAssignedFeatures.'.property_sub_type_id','=',$subTypeId)
            ->get();
    }
}