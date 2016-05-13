<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;

class UpdateUserValidator extends UserValidator implements ValidatorsInterface
{
    public function __construct($request){
        parent::__construct($request);
        $this->request = $request;
    }
    public function CustomValidationMessages(){

        return [
            'required.required' => ':attribute is required',
            'fName.required' => 'First name is required',
            'lName.required' => 'Last name is required',
            'passwordAgain.required' => 'Password Again is required',
            'phone.required' => 'Phone is required',
            'mobile.required' => 'mobile is required',
            'fax.required' => 'fax is required',
            'address.required' => 'address is required',
            'zipCode.required' => 'zipCode is required',
            'countryId.required' => 'countryId is required',
            'notificationSettings.required' => 'notificationSettings is required',

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
            'userId' => 'required',
            'fName' => 'required',
            'lName' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->request->get('userId').'|max:255',
            'password' => 'required|confirmed',
            'mobile'=> 'required',
            'address'=> 'required',
            'zipCode'=> 'required',
            'notificationSettings'=> 'required',
        ];
    }
}