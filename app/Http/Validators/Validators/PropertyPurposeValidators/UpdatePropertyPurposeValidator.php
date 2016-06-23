<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyPurposeValidators;
use App\Http\Validators\Interfaces\ValidatorsInterface;

class UpdatePropertyPurposeValidator extends PropertyPurposeValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'id' => 'required',
            'purpose'=>'required|min:5|max:55',
        ];
    }
}
