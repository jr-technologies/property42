<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Auth;


use App\DB\Providers\SQL\Models\User;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserValidators\AddUserValidator;
use App\Transformers\Request\Auth\AuthenticateUserTransformer;
use App\Transformers\Request\Auth\RegisterUserTransformer;

class RegistrationRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new RegisterUserTransformer($this->getOriginalRequest()));
        $this->validator = new AddUserValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return User::class
     * */
    public function getUserModel()
    {
        $user = new User();
        $user->fName = $this->get('f_name');
        $user->lName = $this->get('l_name');
        $user->email = $this->get('email');
        $user->password = bcrypt($this->get('password'));
        $user->countryId = 1;
        $user->membershipPlanId = 1;
        return $user;
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