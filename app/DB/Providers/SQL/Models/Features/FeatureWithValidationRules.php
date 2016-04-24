<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models\Features;

class FeatureWithValidationRules {

    public $featureId = 0;
    public $featureName;
    public $featureInputName;

    /* array ValidationRuleWithErrorMessage::class */
    public $validationRules = [];

    public $priority = 0;

    public function __construct(){}
} 

