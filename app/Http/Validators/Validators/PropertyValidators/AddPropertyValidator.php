<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Repositories\Repositories\Sql\FeaturesRepository;

class AddPropertyValidator extends PropertyValidator implements ValidatorsInterface
{
    private $featuresRepository = null;
    public function __construct($request)
    {
        parent::__construct($request);
        $this->featuresRepository = new FeaturesRepository();
    }


    private function propertyInfoRules()
    {
        return [
            'ownerId' => 'required|exists:users,id',
            'purposeId' => 'required|exists:property_purposes,id',
            'subTypeId' => 'required|exists:property_sub_types,id',
            'blockId' => 'required|exists:blocks,id',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'landArea' => 'required',
            'landUnitId' => 'required|exists:land_units,id',
        ];
    }

    private function propertyContactInfoRules()
    {
        return [
            'contactPerson' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ];
    }

    public function rules()
    {
        dd($this->featuresRepository->assignedFeaturesWithValidationRules($this->request->get('subTypeId')));
        return array_merge($this->propertyInfoRules(),$this->propertyContactInfoRules());
    }
}

