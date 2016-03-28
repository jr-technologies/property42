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
use App\Transformers\Request\AuthenticateUserTransformer;

class LoginRequest extends Request implements RequestInterface{

    public function __construct(){
        parent::__construct(new AuthenticateUserTransformer($this->getOriginalRequest()));
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return true;
    }
} 