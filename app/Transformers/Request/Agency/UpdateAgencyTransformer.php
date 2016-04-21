<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Agency;


use App\Transformers\Request\RequestTransformer;


class UpdateAgencyTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id'=>$this->request->input('agency_id'),
            'user_id'=>$this->request->input('user_id'),
            'agency_name' => $this->request->input('agency_name'),
            'description'=>$this->request->input('description'),
            'mobile' => $this->request->input('mobile'),
            'phone'=>$this->request->input('phone'),
            'address' => $this->request->input('address'),
            'email'=>$this->request->input('email'),
            'logo' => $this->request->input('logo'),

        ];
    }
}