<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\CountryValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class AddCityValidator extends CityValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'name'=>'required'
        ];
    }
}

