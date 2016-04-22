<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:18 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;

use App\Http\Validators\Validators\AppValidator;

class PropertyValidator extends AppValidator
{
    public function __construct($request){
        parent::__construct($request);
    }
    public function CustomValidationMessages(){
        return [
            /* exists messages */
            'ownerId.exists' => 'Owner is invalid',
            'purposeId.exists' => 'Property purpose is invalid',
            'subTypeId.exists' => 'Property sub type is invalid',
            'blockId.exists' => 'Block is invalid',
            'landUnitId.exists' => 'Land unit is invalid',

            /* required messages */
            'ownerId.required' => 'property owner is required',
            'purposeId.required' => 'Property purpose is required',
            'subTypeId.required' => 'Property sub type is required',
            'blockId.required' => 'Block is required',
            'landUnitId.required' => 'Land unit is required',
            'title.required' => 'Property title is required',
            'description.required' => 'property description is required',
            'price.required' => 'property price is required',
            'landArea.required' => 'land area is required',
            'contactPerson.required' => 'contact person is required',
            'phone.required' => 'company phone is required',
            'email.required' => 'company email is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}