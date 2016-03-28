<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Auth;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserValidators\AddUserValidator;
use App\Transformers\Request\Auth\AuthenticateUserTransformer;
use App\Transformers\Request\Auth\RegisterUserTransformer;

class RegistrationRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new RegisterUserTransformer($this->getOriginalRequest()));
        $this->validator = new AddUserValidator($this->getOriginalRequest());
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getUserInfo()
    {
        return [
            'f_name' => $this->get('f_name'),
            'l_name' => $this->get('l_name'),
            'email' => $this->get('email'),
            'password' => bcrypt($this->get('password')),
            'country_id' => 1,
            'membership_plan_id' => 1,
        ];
    }

    public function getAgencyInfo()
    {
        return [
            'agency' => $this->get('agency')
        ];
    }

    public function userIsAgent()
    {
        return ($this->get('is_agent') == '1')? true : false;
    }
} 