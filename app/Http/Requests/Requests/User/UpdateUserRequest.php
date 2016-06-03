<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\User;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserValidators\UpdateUserValidator;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Transformers\Request\User\UpdateUserTransformer;

class UpdateUserRequest extends Request implements RequestInterface
{

    public $validator;
    private $users;
    public function __construct(){
        parent::__construct(new UpdateUserTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateUserValidator($this);

        $this->users = (new UsersRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getUserModel()
    {
        $user = $this->users->getById($this->get('userId'));
        $user->access_token = $this->getAccessToken();
        $user->address = $this->get('address');
        $user->email = $this->get('email');
        $user->fax = $this->get('fax');
        $user->fName = $this->get('fName');
        $user->lName = $this->get('lName');
        $user->mobile = $this->get('mobile');
        $user->notificationSettings = $this->get('notificationSettings');
        $user->password = $this->get('password');
        $user->phone = $this->get('phone');
        $user->zipCode = $this->get('zipCode');
        return $user;
    }

} 