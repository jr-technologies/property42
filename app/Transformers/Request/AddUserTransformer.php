<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request;


class AddUserTransformer extends RequestTransformer{

    public function transform(){
        return [
            'l_name'=>$this->request->get('l_name'),
            'f_name'=>$this->request->get('f_name'),
            'email'=>$this->request->get('email'),
            'password'=>$this->request->get('password'),
            'is_agent'=>0,
            'country_id' => 1,
            'membership_plan_id' => 1,
            'agency'=>null
        ];
    }
} 