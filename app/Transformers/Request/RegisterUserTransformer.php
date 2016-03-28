<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request;


class RegisterUserTransformer extends RequestTransformer{

    public function transform($data){
        return $this->request->all();
    }
} 