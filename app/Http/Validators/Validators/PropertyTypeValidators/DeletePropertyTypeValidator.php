<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyTypeValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Http\Validators\Validators\PropertyPurposeValidators\PropertyPurposeValidator;

class DeletePropertyTypeValidator extends PropertyPurposeValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'id' => 'required',
        ];
    }
}

