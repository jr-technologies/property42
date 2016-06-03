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
                'userId'=>'required',
                'agencyName' => 'required',
                'companyMobile' => 'required',
                'companyPhone'=>'required',
                'companyAddress' =>'required',
                'companyEmail'=>'required',

            ];
    }
}

