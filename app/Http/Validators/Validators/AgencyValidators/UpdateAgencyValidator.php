<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\AgencyValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
class UpdateAgencyValidator extends AgencyValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
                'id'=>'required',
                'user_id'=>'required',
                'agency_name' => 'required',
                'description'=>'required',
                'mobile' => 'required',
                'phone'=>'required',
                'address' =>'required',
                'email'=>'required',

            ];
    }
}

