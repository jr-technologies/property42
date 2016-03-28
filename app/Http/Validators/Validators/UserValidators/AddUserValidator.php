<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;


class AddUserValidator extends UserValidator implements ValidatorsInterface
{
    public function __construct($request){
        parent::__construct($request);
    }
    public function CustomValidationMessages(){
        return [
            //
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
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required'
        ];
    }
}