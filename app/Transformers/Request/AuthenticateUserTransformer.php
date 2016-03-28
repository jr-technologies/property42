<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request;


class AuthenticateUserTransformer extends RequestTransformer{

    public function transform($data){
        return [
            'email'=>$data['email'],
            'password'=>$data['password']
        ];
    }
} 