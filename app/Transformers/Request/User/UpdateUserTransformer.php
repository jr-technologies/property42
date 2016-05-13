<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\User;


use App\Transformers\Request\RequestTransformer;

class UpdateUserTransformer extends RequestTransformer{

    public function transform(){

        return [
            'userId'=>$this->request->input('user_id'),
            'lName'=>$this->request->input('l_name'),
            'fName'=>$this->request->input('f_name'),
            'email'=>$this->request->input('email'),
            'password'=>$this->request->input('password'),
            'password_confirmation' => $this->request->input('password_confirmation'),
            'phone' =>$this->request->input('phone'),
            'mobile'=>$this->request->input('mobile'),
            'fax'=> $this->request->input('fax'),
            'address'=> $this->request->input('address'),
            'zipCode'=>$this->request->input('zip_code'),
            'notificationSettings'=> $this->request->input('notification_settings'),

        ];
    }
} 